@extends('layouts.master')

@section('title', 'Post Details')
@section('pageTitle', 'Post Details')

@section('content')
    <section class="content">

        <!-- Post Details Box -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $post->description }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($post->status == 1)
                                <p style="color:Green">Active</p>
                            @else
                                <p style="color:Red">Inactive</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $post->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $post->updated_at }}</td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
            </div>
        </div>
        <!-- /.card -->

    </section>
@endsection
