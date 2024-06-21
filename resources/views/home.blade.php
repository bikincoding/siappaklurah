@extends('layouts.app_admin')

@section('content')
<div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" id="addButton">Add</button>

                    <table id="example" class="table table-sm table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Banjar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contoh data -->
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>adsjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>ghjgfhfgnjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Banjar Example</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <!-- Tambahkan lebih banyak data di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
