@extends('layouts.master')
@section('title', 'Add todo')
@section('pageTitle','Posts')
@section('content')
    <section class="content">
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Created by</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['rows'] as $i => $row)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>
                                    @if($row->image)
                                        <img src="{{ asset('storage/'.$row->image) }}" alt="Post Image" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{$row->title}}</td>
                                <td>{{ Str::limit($row->description, 50) }}</td>
                                <td>{{ $row->category->title ?? 'N/A' }}</td>
                                <td>{{ $row->creator->name }}</td>
                                <td>
                                    @if($row->status==1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('posts.show',$row->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{route('posts.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                    <form action="{{route('posts.destroy',$row->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('style')
    <style>
        .center-form {
            margin: auto;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
@endsection
