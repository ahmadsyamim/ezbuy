@extends('Bulma.layouts.default')
@section('meta_title', 'Search Results')
@section('meta_description', 'Search Results')
@section('page_title', 'Site Search')

@section('content')
    @include('Bulma.partials.page-title')

    <div class="vspace-2"></div>

    <div class="grid-container">
        <div class="cell small-12">
            <div class="grid-x grid-padding-x">
                <div class="cell small-12">
                    <div class="vspace-1"></div>

                    @include('Bulma.partials.search-box')

                    <div class="vspace-1"></div>
                    <hr />
                </div>

                @foreach($resultCollections as $collectionName => $collection)
                    @if (count($collection) > 0)
                        <div class="cell small-12">
                            <h3>{{ ucfirst($collectionName) }}s</h3>
                        </div> <!-- /.cell -->

                        @foreach($collection as $result)
                            @includeFirst([
                                "Bulma.modules.search.result-$collectionName",
                                "Bulma.modules.search.result"
                            ])
                        @endforeach

                        <div class="cell small-12"><hr /></div>
                    @endif
                @endforeach
            </div> <!-- /.grid -->
        </div> <!-- /.cell -->
    </div> <!-- /.grid-container -->
@endsection
