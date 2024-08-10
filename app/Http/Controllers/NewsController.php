<?php

namespace App\Http\Controllers;

use \Log;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Iklan;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        News::create([
            'title' => $validated['title'],
            'thumbnail' => $thumbnailPath,
            'content' => $validated['content'],
            'category_id' => $request->category_id,
            'slug' => str_replace(' ', '-', strtolower($request->title)),
            'views' => 0,
            'user_id' => Auth::user()->id,
            'is_headline' => $request->has('is_headline') ? $request->is_headline : false,
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
    }


    public function show($news)
    {
        $news = News::where('slug', $news)->firstOrFail();
        $pilihanNews = News::where('is_pilihan', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $categories = Category::all();
        $relatedPosts = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id) // Exclude the current post
            ->limit(4) // Limit the number of related posts
            ->get();
        $comments = Comment::where('news_id', $news->id)->get();
        $news->increment('views');
        $iklan = Iklan::all(); // Ambil semua data iklan
        return view('news.show', compact('comments', 'news', 'pilihanNews', 'categories', 'relatedPosts', 'iklan'));
    }

    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $news)
    {
        $news = News::findOrFail($news);

        // Validasi input
        $validated = $request->validate([
            'title' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        // Update berita
        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diupdate.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }

    // melihat berita dengan kategori terkait
    public function showCategory($categorySlug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Ambil berita-berita yang terkait dengan kategori tersebut
        $news = News::where('category_id', $category->id)->get();
        $categories = Category::all(); // Ambil semua kategori

        $pilihanNews = News::where('is_pilihan', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $iklan = Iklan::all(); // Ambil semua data iklan

        return view('news.category', compact('category', 'news', 'pilihanNews', 'categories', 'iklan'));
    }

    // memilih termasuk berita headline atau bukan
    public function toggleHeadline($id)
    {
        $news = News::findOrFail($id);

        // Jika berita sudah merupakan headline
        if ($news->is_headline) {
            // Set status headline menjadi false
            $news->is_headline = false;
        } else {
            $currentHeadlines = News::where('is_headline', true)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            // Jika sudah ada 3 headline, hapus yang terlama
            if ($currentHeadlines->count() >= 3) {
                $oldestHeadline = $currentHeadlines->last(); // Berita headline yang paling lama
                $oldestHeadline->is_headline = false;
                $oldestHeadline->save();
            }

            // Set status headline menjadi true
            $news->is_headline = true;
        }

        $news->save();

        return redirect()->back()->with('success', 'Status headline berhasil diupdate.');
    }

    public function toggleTampil($id)
    {
        $iklan = Iklan::findOrFail($id);

        // Jika iklan sudah merupakan iklan pilihan
        if ($iklan->is_tampil) {
            // Set status pilihan menjadi false
            $iklan->is_tampil = false;
        } else {
            // Ambil iklan pilihan yang sudah ada
            $currentPilihan = Iklan::where('is_tampil', true)
                ->orderBy('created_at', 'desc')
                ->take(2) // Hanya ambil 2 iklan pilihan yang terbaru
                ->get();

            // Jika sudah ada 2 iklan pilihan, hapus yang terlama
            if ($currentPilihan->count() >= 2) {
                $oldestPilihan = $currentPilihan->last(); // Iklan pilihan yang paling lama
                $oldestPilihan->is_tampil = false;
                $oldestPilihan->save();
            }

            // Set status pilihan menjadi true
            $iklan->is_tampil = true;
        }

        $iklan->save();

        return redirect()->back()->with('success', 'Status iklan berhasil diupdate.');
    }


    // memilih termasuk berita pilihan atau bukan
    public function togglePilihan($id)
    {
        $news = News::findOrFail($id);

        // Jika berita sudah merupakan headline
        if ($news->is_pilihan) {
            // Set status headline menjadi false
            $news->is_pilihan = false;
        } else {
            // Jika berita belum menjadi headline
            // Ambil 3 berita headline terbaru
            $currentPilihan = News::where('is_pilihan', true)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Jika sudah ada 3 headline, hapus yang terlama
            if ($currentPilihan->count() >= 5) {
                $oldestPilihan = $currentPilihan->last(); // Berita headline yang paling lama
                $oldestPilihan->is_pilihan = false;
                $oldestPilihan->save();
            }

            // Set status headline menjadi true
            $news->is_pilihan = true;
        }

        $news->save();

        return redirect()->back()->with('success', 'Status berita pilihan berhasil diupdate.');
    }

    // menampilkan berita pada halaman utama
    public function getBerita(Request $request)
    {
        $categories = Category::all();

        $allNews = News::all();

        $newsByCategory = $categories->mapWithKeys(function ($category) {
            return [$category->name => News::where('category_id', $category->id)->latest()->take(3)->get()];
        });

        $latestNews = News::latest()->take(2)->get();

        $headlines = News::where('is_headline', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $pilihanNews = News::where('is_pilihan', true)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $beritaFavorit = News::orderBy('views', 'desc')->take(5)->get();
        $iklan = Iklan::all(); // Ambil semua data iklan

        return view('news.index', compact('headlines', 'categories', 'newsByCategory', 'latestNews', 'pilihanNews', 'allNews', 'beritaFavorit', 'iklan'));
    }

    // fungsi search
    public function search(Request $request)
    {

        $query = $request->input('query');
        $categories = Category::all();
        $iklan = Iklan::all(); // Ambil semua data iklan

        // Cari berita berdasarkan judul atau isi
        $news = News::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->get();

        return view('news.search', compact('news', 'query', 'categories', 'iklan'));
    }
}
