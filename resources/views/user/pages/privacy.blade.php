<x-user.header></x-user.header>
<div class="page-hero">
    <div class="container">
        <h1>Privacy Policy</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a><span class="breadcrumb-sep">›</span><span>Privacy Policy</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width:800px">
        <p style="color:var(--text-muted);margin-bottom:2rem">Last updated: {{ date('F j, Y') }}</p>
        @foreach ($sections as $title => $body)
            <div style="margin-bottom:2.5rem">
                <h3 style="margin-bottom:0.75rem;color:var(--gold)">{{ e($title) }}</h3>
                <p style="line-height:1.9">{{ e($body) }}</p>
            </div>
        @endforeach
    </div>
</section>

<x-user.footer></x-user.footer>
