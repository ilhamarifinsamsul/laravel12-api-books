<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $apiUrl;
    private $client;

    public function __construct()
    {
        $this->apiUrl = "http://127.0.0.1:8000/api/books";
        $this->client = new Client();
    }

    public function index()
    {
        // $client = new Client();
        // $url = "http://127.0.0.1:8000/api/books";
        // $response = $client->request('GET', $url);
        // $contentArray = json_decode($response->getBody(), true);
        // $data = $contentArray['data'];

        // return view('book.index', [
        //     'data' => $data,
        // ]);

        try {
            $response = $this->client->request('GET', $this->apiUrl);
            $contentArray = json_decode($response->getBody(), true);
            $data = $contentArray['data'];

            return view('book.index', [
                'data' => $data,
            ]);
        }
        catch (RequestException $e)
        {
            return view('book.index', [
                'data' => [],
                'error' => 'Failed to fetch data from the API: ' . $e->getMessage(),
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = $request->title;
        $pengarang = $request->pengarang;
        $tanggal_terbit = $request->tanggal_terbit;

        $response = $this->client->request('POST', $this->apiUrl, [
            'Accept' => [
                'Content-type' => 'application/json',
            ],
            'form_params' => [
                'title' => $title,
                'pengarang' => $pengarang,
                'tanggal_terbit' => $tanggal_terbit,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        
        if ($contentArray['success'] != true)
        {
            $error = $contentArray['data'];
            return redirect()->to('books')
                ->withErrors($error)
                ->withInput();
        } else 
        {
            return redirect()->to('books')
                ->with('success', 'Buku berhasil ditambahkan');
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $response = $this->client->request('GET', $this->apiUrl . '/' . $id);
        $contentArray = json_decode($response->getBody(), true);
            
        if ($contentArray['success'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('books')->withErrors($error)->withInput();
        } else {
            $data = $contentArray['data'];
            return view('book.index', [
                'data' => $data,
            ]);
        }
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $title = $request->title;
        $pengarang = $request->pengarang;
        $tanggal_terbit = $request->tanggal_terbit;

        $response = $this->client->request('PUT', $this->apiUrl . '/' . $id, [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'title' => $title,
                'pengarang' => $pengarang,
                'tanggal_terbit' => $tanggal_terbit,
            ]
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        
        if ($contentArray['success'] != true)
        {
            $error = $contentArray['data'];
            return redirect()->to('books')
                ->withErrors($error)
                ->withInput();
        } else 
        {
            return redirect()->to('books')
                ->with('success', 'Buku berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete data buku
        $response = $this->client->request('DELETE', $this->apiUrl . '/' . $id);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['success'] != true)
        {
            $error = $contentArray['data'];
            return redirect()->to('books')
                ->withErrors($error)
                ->withInput();
        } else 
        {
            return redirect()->to('books')
                ->with('success', 'Buku berhasil dihapus');
        }
    }
}
