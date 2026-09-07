<x-user.header></x-user.header>

<div class="page-hero">
    <div class="container">
        <h1>Terms of Service</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a><span class="breadcrumb-sep">›</span><span>Terms of Service</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width:800px">
        <p style="color:var(--text-muted);margin-bottom:2rem">Last updated: {{ date('F j, Y') }}</p>
        <p style="line-height:1.9;margin-bottom:2rem">By accessing or using Luxe Shop, you agree to be bound by these
            Terms of Service. Please read them carefully before making a purchase.</p>

        @foreach ($terms as $key => $value)
            <div style="margin-bottom:2.5rem">
                <h3 style="margin-bottom:0.75rem;color:var(--gold)">{{ e($key) }}</h3>
                <p style="line-height:1.9">{{ e($value) }}</p>
            </div>
        @endforeach

        <div style="margin-top:3rem;padding:1.5rem;border:1px solid var(--border);border-radius:var(--radius-md)">
            <p style="font-size:0.85rem;line-height:1.8">
                Questions about these terms? <a href="/contact" style="color:var(--gold)">Contact us</a> and we'll be
                happy to help.
            </p>
        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
