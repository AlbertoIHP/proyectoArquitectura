<?php

namespace App\Http\Controllers;

use App\DataTables\ArticleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ArticleController extends AppBaseController
{
    /** @var  ArticleRepository */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepository = $articleRepo;
    }

    /**
     * Display a listing of the Article.
     *
     * @param ArticleDataTable $articleDataTable
     * @return Response
     */
    public function index(ArticleDataTable $articleDataTable)
    {
        return $articleDataTable->render('articles.index');
    }

    /**
     * Show the form for creating a new Article.
     *
     * @return Response
     */
    public function create()
    {


        //Se cruza con el modelo de la clave foranea
        $spaces = \App\Models\Space::pluck('name', 'id');
        return view('articles.create')->with('spaces',$spaces);
    }

    /**
     * Store a newly created Article in storage.
     *
     * @param CreateArticleRequest $request
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request)
    {
        $input = $request->all();

        $article = $this->articleRepository->create($input);

        Flash::success('Article saved successfully.');

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified Article.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        return view('articles.edit')->with('article', $article);
    }

    /**
     * Update the specified Article in storage.
     *
     * @param  int              $id
     * @param UpdateArticleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $article = $this->articleRepository->update($request->all(), $id);

        Flash::success('Article updated successfully.');

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified Article from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->findWithoutFail($id);

        if (empty($article)) {
            Flash::error('Article not found');

            return redirect(route('articles.index'));
        }

        $this->articleRepository->delete($id);

        Flash::success('Article deleted successfully.');

        return redirect(route('articles.index'));
    }
}
