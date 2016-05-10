<?php

// Books
Breadcrumbs::register('admin.books.index', function($breadcrumbs)
{
    $breadcrumbs->push('Book', route('admin.books.index'));
});

// Books / {title} / Edit
Breadcrumbs::register('admin.books.edit', function($breadcrumbs, $book)
{
    $breadcrumbs->push('Book', route('admin.books.index'));
    $breadcrumbs->push($book->title, route('admin.books.show', ['book'=> $book]));
    $breadcrumbs->push('Edit');
});

// Books / New
Breadcrumbs::register('admin.books.new', function($breadcrumbs)
{
    $breadcrumbs->push('Book', route('admin.books.index'));
    $breadcrumbs->push('New');
});

// Books / {title} 
Breadcrumbs::register('admin.books.show', function($breadcrumbs, $book)
{
    $breadcrumbs->push('Book', route('admin.books.index'));
    $breadcrumbs->push($book->title);
});
