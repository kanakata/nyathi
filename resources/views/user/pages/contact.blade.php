<x-user.header></x-user.header>

<div class="page-hero">
    <div class="container">
        <h1>Get in Touch</h1>
        <nav class="breadcrumb">
            <a href="/index.php">Home</a>
            <span class="breadcrumb-sep">›</span>
            <span>Contact</span>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1.4fr;gap:5rem;align-items:start">

            <!-- Info -->
            <div>
                <h2 style="margin-bottom:1rem">We'd Love to Hear From You</h2>
                <div class="divider left"></div>
                <p style="line-height:1.9;margin-bottom:2rem">
                    Our customer care team is available Monday through Friday, 9am–6pm EAT.
                    We aim to respond to all enquiries within 24 hours.
                </p>

                <div style="display:flex;flex-direction:column;gap:1.5rem">
                    <div class="feature-item" style="padding:0">
                        <div class="feature-icon">✉</div>
                        <div class="feature-text">
                            <h4>Email</h4>
                            <a href="mailto:hello@luxeshop.com"
                                style="color:var(--gold);font-size:0.85rem">hello@luxeshop.com</a>
                        </div>
                    </div>
                    <div class="feature-item" style="padding:0">
                        <div class="feature-icon">☎</div>
                        <div class="feature-text">
                            <h4>Phone / WhatsApp</h4>
                            <a href="tel:+254700000000" style="color:var(--gold);font-size:0.85rem">+254 700 000 000</a>
                        </div>
                    </div>
                    <div class="feature-item" style="padding:0">
                        <div class="feature-icon">◈</div>
                        <div class="feature-text">
                            <h4>Visit Us</h4>
                            <p style="font-size:0.85rem">Westlands Square, 3rd Floor<br>Nairobi, Kenya</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top:2.5rem">
                    <div class="sidebar-title" style="margin-bottom:0.75rem">Follow Us</div>
                    <div class="social-links">
                        <a href="#" class="social-link">IG</a>
                        <a href="#" class="social-link">FB</a>
                        <a href="#" class="social-link">TW</a>
                        <a href="#" class="social-link">PT</a>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="card" style="padding:2.5rem">
                @if (!empty($_GET['sent']))
                    <div class="alert alert-success">Your message has been received. We'll be in touch soon!</div>
                @endif

                <form method="POST" action="/pages/contact-process.php">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select id="subject" name="subject" class="form-control">
                            <option value="">Select a topic…</option>
                            <option>Order enquiry</option>
                            <option>Return / Exchange</option>
                            <option>Product information</option>
                            <option>Wholesale / Partnership</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order_id">Order ID (optional)</label>
                        <input type="text" id="order_id" name="order_id" class="form-control"
                            placeholder="e.g. LX-A4F1E2">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" class="form-control" rows="5" data-maxlength="1000"
                            required style="resize:vertical"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>

        </div>
    </div>
</section>

<x-user.footer></x-user.footer>
