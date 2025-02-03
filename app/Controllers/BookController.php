<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;

class BookController extends Controller
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        $data['books'] = $this->bookModel->findAll();
        return view('books/index', $data);
    }

    public function create()
    {
        return view('books/create');
    }

    public function store()
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'description' => $this->request->getPost('description')
        ];

        $this->bookModel->insert($data);
        return redirect()->to('/books')->with('success', 'Book added successfully');
    }

    public function edit($id)
    {
        $data['book'] = $this->bookModel->find($id);
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'description' => $this->request->getPost('description')
        ];

        $this->bookModel->update($id, $data);
        return redirect()->to('/books')->with('success', 'Book updated successfully');
    }

    public function delete($id)
    {
        $this->bookModel->delete($id);
        return redirect()->to('/books')->with('success', 'Book deleted successfully');
    }

    public function generatePdf()
    {
        $data['books'] = $this->bookModel->findAll();
        $html = view('books/pdf_template', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('books_list.pdf', ['Attachment' => 0]);
    }
}
