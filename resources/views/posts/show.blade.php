@extends('layouts.master')

@section('title', 'Post Details')
@section('pageTitle', 'Post Details')

@section('content')
    <section class="content">

        <!-- Post Details Box -->
        <div class="card">
            <div class="card-body">
                <!-- Image Display -->
                @if($post->image)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/'.$post->image) }}"
                             alt="Post Image"
                             class="img-fluid rounded"
                             style="max-height: 300px;">
                    </div>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! nl2br(e($post->description)) !!}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $post->category->title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($post->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{ $post->creator->name ?? 'Unknown' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $post->created_at->format('M d, Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $post->updated_at->format('M d, Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Posts
                </a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary float-right">
                    <i class="fas fa-edit"></i> Edit Post
                </a>
            </div>
        </div>
        <!-- /.card -->

    </section>
@endsection

@section('styles')
    <style>
        .table th {
            background-color: #f8f9fa;
        }
        .badge {
            padding: 5px 10px;
            font-size: 14px;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
