@include('partials.header')
<style>
    @media (max-width: 768px) {
        .breadcrumb-section h2 {
            font-size: 30px;
        }

        .breadcrumb-section .bt-option a,
        .breadcrumb-section .bt-option span {
            font-size: 15px;
        }
    }

    .announcement-message {
        text-align: center;
        font-size: 25px;
        font-weight: normal;
    }

    @media (max-width: 768px) {
b
        .announcement-message {
            font-size: 17px;
        }
    }
</style>
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Announcement</h2>
                    <div class="bt-option">
                        <a href="/">Home</a>
                        <span>Announcement</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Announcement Section Begin -->
<section class="blog-details-section">
    <div class="container" style="cursor: default;">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if ($announcement->isEmpty())
                    <p class="announcement-message">No announcements available.</p>
                    <br>
                    <br>
                @else
                    @foreach ($announcement->where('published', true)->sortByDesc('created_at') as $announce)
                        <div class="card mb-4" id="card-{{ $announce->id }}">
                            <div class="card-header" style="background-color: rgb(235, 235, 235);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-2">
                                            <img class="rounded-circle" width="45"
                                                src="assets-applicant/img/profile.png" alt="Profile Picture">
                                        </div>
                                        <div class="ml-2">
                                            <div class="h5 m-0 f-para">{!! $announce->title !!}</div>
                                            <div class="text-muted h7 mb-2" style="font-size:14px;">
                                                @php
                                                    $created = \Carbon\Carbon::parse($announce->created_at)->timezone(
                                                        'Asia/Manila',
                                                    );
                                                    $now = \Carbon\Carbon::now()->timezone('Asia/Manila');
                                                    $diffInHours = $created->diffInHours($now);
                                                @endphp

                                                @if ($diffInHours >= 12)
                                                    {{ $created->isoFormat('MMMM D, YYYY, h:mm A') }} (Posted by Real
                                                    LIFE BGC)
                                                @else
                                                    {{ $created->diffForHumans(['suffix' => true]) }} (Posted by Real
                                                    LIFE BGC)
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="card-body-{{ $announce->id }}">
                                @php
                                    $fullContent = preg_replace(
                                        '/<img(.*?)src="data:image\/jpeg;base64,(.*?)"(.*?)>/i',
                                        '<a href="data:image/jpeg;base64,$2" target="_blank"$1$3><img$1src="data:image/jpeg;base64,$2"$3></a>',
                                        $announce->caption,
                                    );
                                    $shortContent = substr(strip_tags($fullContent), 0, 600);
                                @endphp
                                <div id="short-content-{{ $announce->id }}">
                                    {!! $shortContent !!}
                                    @if (strlen(strip_tags($fullContent)) > 500)
                                        <span>...</span>
                                        <button class="btn btn-link p-0 mt-2" id="see-more-{{ $announce->id }}"
                                            onclick="toggleContent('{{ $announce->id }}')">See More</button>
                                    @endif
                                </div>
                                <div id="full-content-{{ $announce->id }}" style="display: none;">
                                    {!! $fullContent !!}
                                    <button class="btn btn-link p-0 mt-2" id="see-less-{{ $announce->id }}"
                                        onclick="toggleContent('{{ $announce->id }}')">See Less</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

@include('partials.footer')
