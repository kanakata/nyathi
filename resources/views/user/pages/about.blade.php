<x-user.header></x-user.header>

<div class="page-hero">
    <div class="container">
        <h1>Our Story</h1>
        <nav class="breadcrumb">
            <a href="/">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>About</span>
        </nav>
    </div>
</div>

<!-- Mission -->
<section class="section">
    <div class="container" style="max-width:860px">
        <div class="section-header">
            <h2>Fashion That Means Something</h2>
            <div class="divider"></div>
            <p style="font-size:1.05rem;line-height:1.9;max-width:680px;margin:0 auto"> Nyathi was founded on a simple
                belief: that beautiful, well-made sports wear should be accessible without compromising on integrity. We
                source exclusively from ethical manufacturers and suppliers.
            </p>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;margin-top:4rem;align-items:center">
            <div>
                <div style="aspect-ratio:4/5;background:var(--surface-2);overflow:hidden">
                    <img src="/assets/images/banners/about1.jpg" alt="Our atelier"
                        style="width:100%;height:100%;object-fit:cover">
                </div>
            </div>
            <div>
                <div class="hero-eyebrow">Est. 2019</div>
                {{-- <h3 style="margin-bottom:1rem">Crafted with Care</h3> --}}
                <p style="line-height:1.9;margin-bottom:1.5rem">
                    Every wear in our collection is reviewed by our in-house quality team before it reaches you.

                </p>
                <p style="line-height:1.9">
                    Our packaging is 100% recyclable.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="section" style="background:var(--surface)">
    <div class="container">
        <div class="section-header">
            <h2>Our Values</h2>
            <div class="divider"></div>
        </div>
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">✦</div>
                <div class="feature-text">
                    <h4>Quality First</h4>
                    <p>Every piece is inspected against our 27-point quality standard before shipping.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">◈</div>
                <div class="feature-text">
                    <h4>Ethical Sourcing</h4>
                    <p>We partner only with manufacturers who pay fair wages and maintain safe workplaces.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">◉</div>
                <div class="feature-text">
                    <h4>Sustainability</h4>
                    <p>Carbon-neutral shipping, recycled packaging, and a take-back programme for worn items.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon">◆</div>
                <div class="feature-text">
                    <h4>Timeless Design</h4>
                    <p>We invest in classics, not fast fashion — pieces built to last for years, not seasons.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Meet the Team</h2>
            <div class="divider"></div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:2rem">
            @foreach ($team as $member)
                <div style="text-align:center">
                    <div
                        style="width:120px;height:120px;border-radius:50%;background:var(--surface-2);margin:0 auto 1.25rem;border:2px solid var(--gold-dark)">
                    </div>
                    <h4 style="font-family:var(--font-display);font-size:1.1rem;margin-bottom:0.25rem">
                        {{ e($member['name']) }}
                    </h4>
                    <p style="font-size:0.78rem;letter-spacing:0.06em;color:var(--gold)">{{ e($member['role']) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
