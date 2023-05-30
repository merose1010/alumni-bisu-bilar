<section id="news-announce">
    <div class="news-announce-row">
        <h1>News & Announcements</h1>
        <div class="news-announce-col">
            @if(count($announce) > 0)
                @foreach($announce as $item)
                    <div class="na-card">
                        <div class="na-date">
                            <h4>{{ date('M j', strtotime($item->date)) }}</h4>
                            <h2>{{ date('Y', strtotime($item->date)) }}</h2>
                        </div>
                        <div class="na-content">
                            <h5>{{ $item->subject}}</h5>
                            <p>{{ $item->description}}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="no-data">No Announcement is Posted.</p>
            @endif
        </div>
    </div>
</section>
