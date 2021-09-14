@extends('admin.layouts.main')

@section('content')
    <!-- Page content-->
    <div class="container-fluid">

        <div class="allcontents bg-white p-2 mt-2">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumblinks">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Questions Asked</li>
                </ol>
            </nav>


            <!-- table -->
            <div id="alldatatable" class="bg-white mt-2 pt-3">

                <p class="fw-bold">Total Questions : {{ count($questions) }}</p>
                @forelse ($questions as $index => $question)
                    <div class="faqitem">
                        <p class="fw-bold mb-0">Question - {{$index+1}}</p>
                        <div class="faq-prodname">
                            <a href="{{ route('products.show', $question->product) }}" class="mb-1">{{ $question->product->name }}</a>
                        </div>
                        <form action="{{ route('admin.questions.update', $question) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="faq-questans">
                                <label for="exampleFormControlTextarea1" class="form-label">{{ $question->question }} <br> <small>By {{ $question->user->name }} ({{ $question->created_at->diffForHumans() }})</small></label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    placeholder="Write Your Answer Here..." name="answer">{{ old('answer') }}</textarea>
                            </div>
                            <div class="faq-postans mt-2">
                                <button class="btn btn-sm orangebg" type="submit">Post Answer</button>
                            </div>
                        </form>
                    </div>
                @empty
                   <p>No unanswered questions available</p> 
                @endforelse

            <!-- pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-end">
                    {{ $questions->links('pagination::bootstrap-4') }}
                </ul>
            </nav>
        </div>

    </div>
    <!-- Page content ends-->
@endsection