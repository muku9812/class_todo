@extends('layouts.master')

@section('title', 'Category Details')
@section('pageTitle', 'Category Details')

@section('content')
    <section class="content">

        <!-- Post Details Box -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $category->title }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($category->status == 1)
                                <p style="color:Green">Active</p>
                            @else
                                <p style="color:Red">Inactive</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at }}</td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('category.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Category
                </a>
                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary float-right">
                    <i class="fas fa-edit"></i> Edit Category
                </a>
            </div>
        </div>
        <!-- /.card -->

    </section>
@endsection
