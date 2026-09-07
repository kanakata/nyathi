<x-user.header></x-user.header>
<div class="page-hero">
    <div class="container">
        <h1>Careers</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>Careers</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container" style="max-width:800px">

        @foreach ($faqs as $group => $items)
            <div style="margin-bottom:3.5rem">
                <h2 style="font-size:1.4rem;margin-bottom:1.5rem;color:var(--gold)">{{ e($group) }}</h2>
                <div style="display:flex;flex-direction:column;gap:1px">
                    @foreach ($items as $faq)
                        <details class="card" style="padding:1.25rem 1.5rem;cursor:pointer">
                            <summary
                                style="font-family:var(--font-display);font-size:1rem;list-style:none;display:flex;justify-content:space-between;align-items:center;color:var(--text)">
                                {{ e($faq['q']) }}
                                <span style="color:var(--gold);font-size:1.2rem;transition:transform 0.3s">+</span>
                            </summary>
                            <p style="margin-top:1rem;line-height:1.8">{{ e($faq['a']) }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div style="text-align:center;padding:2rem;border:1px solid var(--border);border-radius:var(--radius-md)">
            <h3 style="margin-bottom:0.5rem">Still have questions?</h3>
            <p style="margin-bottom:1.5rem">Our support team is happy to help.</p>
            <a href="/contact" class="btn btn-primary">Contact Us</a>
        </div>
    </div>
</section>

<style>
    details[open] summary span {
        transform: rotate(45deg);
        display: inline-block;
    }

    details summary::-webkit-details-marker {
        display: none;
    }
</style>
<x-user.footer></x-user.footer>
