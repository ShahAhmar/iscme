<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual Page Builder - ISCME 2027</title>
    <!-- GrapesJS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.2/css/grapes.min.css">
    <style>
        body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; font-family: sans-serif; }
        #gjs { border: 3px solid #444; }
        .panel__top {
            padding: 0;
            width: 100%;
            display: flex;
            position: initial;
            justify-content: space-between;
            background: #2a2a2a;
            align-items: center;
        }
        .admin-bar-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 8px 16px;
            margin: 8px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .admin-bar-btn:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>

    <div class="panel__top">
        <div class="panel__basic-actions">
            <a href="{{ route('admin.pages.index') }}" class="admin-bar-btn" style="text-decoration: none; display: inline-block; background-color: #6c757d;">&larr; Back to Admin</a>
            <button id="btn-show-blocks" class="admin-bar-btn" style="background-color: #198754;">🧩 Drag & Drop Blocks</button>
        </div>
        <div>
            <span style="color: white; margin-right: 15px;">Editing: <strong>{{ $page->title }}</strong></span>
            <button id="save-page" class="admin-bar-btn">Save Changes</button>
        </div>
    </div>
    
    <div id="gjs"></div>

    <!-- GrapesJS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.2/grapes.min.js"></script>
    
    <script>
        const editor = grapesjs.init({
            container: '#gjs',
            fromElement: true,
            height: 'calc(100vh - 45px)',
            width: 'auto',
            storageManager: false,
            canvas: {
                styles: @json($canvasStyles),
            },
        });

        // Open Block Manager by default
        editor.on('load', () => {
            const openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
            if (openBlocksBtn) {
                openBlocksBtn.set('active', true);
            }
        });

        document.getElementById('btn-show-blocks')?.addEventListener('click', function() {
            const openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
            if (openBlocksBtn) {
                openBlocksBtn.set('active', true);
            }
        });

        // Load existing page data safely
        const existingHtml = @json($page->html ?? '');
        const existingCss = @json($page->css ?? '');

        if (existingHtml && existingHtml.trim().length > 0) {
            editor.setComponents(existingHtml);
        }

        if (existingCss && existingCss.trim().length > 0) {
            editor.setStyle(existingCss);
        }

        // Add Custom ISCME Page Section & Basic Blocks
        const bm = editor.BlockManager;

        bm.add('heading-block', {
            label: 'Heading',
            category: 'Basic Elements',
            content: '<h2 class="fw-bold text-primary mb-3">Section Title</h2>'
        });

        bm.add('text-block', {
            label: 'Text Paragraph',
            category: 'Basic Elements',
            content: '<p class="text-muted" style="font-size:1.05rem; line-height:1.7;">Enter your content paragraph text here. Click directly to edit text.</p>'
        });

        bm.add('button-block', {
            label: 'Button',
            category: 'Basic Elements',
            content: '<a href="#" class="btn btn-primary px-4 py-2 fw-semibold">Click Here</a>'
        });

        bm.add('two-column-card', {
            label: '2-Column Layout',
            category: 'Layout Blocks',
            content: `
                <section class="py-5 bg-white">
                    <div class="container py-4">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <h3 class="fw-bold mb-3" style="color:#003d6c;">Section Heading</h3>
                                <p class="text-muted mb-4" style="line-height:1.8;">Detailed description text goes here. You can edit this text directly inside the editor.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm p-4 rounded-4" style="background:#f8f9fa;">
                                    <h5 class="fw-bold text-primary mb-2">Highlight Box</h5>
                                    <p class="text-muted mb-0">Highlight important information, criteria, or notice here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        bm.add('hero-header', {
            label: 'Hero Header',
            category: 'ISCME Sections',
            content: `
                <section class="py-5 text-white" style="background: linear-gradient(135deg, #071e3d, #003d6c);">
                    <div class="container py-5 text-center">
                        <h1 class="display-4 fw-bold mb-3">Header Title</h1>
                        <p class="lead mb-4" style="max-width:700px; margin:0 auto;">Add your subtitle or brief description here for this page section.</p>
                        <a href="#" class="btn btn-primary btn-lg px-4 fw-semibold">Action Button</a>
                    </div>
                </section>
            `
        });

        bm.add('three-feature-cards', {
            label: '3 Feature Cards',
            category: 'ISCME Sections',
            content: `
                <section class="py-5 bg-light">
                    <div class="container py-4 text-center">
                        <h2 class="fw-bold mb-5" style="color:#003d6c;">Key Highlights</h2>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white">
                                    <h5 class="fw-bold mb-2">Feature 1</h5>
                                    <p class="text-muted small mb-0">Brief description of the first feature or track.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white">
                                    <h5 class="fw-bold mb-2">Feature 2</h5>
                                    <p class="text-muted small mb-0">Brief description of the second feature or track.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm p-4 rounded-4 h-100 bg-white">
                                    <h5 class="fw-bold mb-2">Feature 3</h5>
                                    <p class="text-muted small mb-0">Brief description of the third feature or track.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            `
        });

        // Handle Save
        document.getElementById('save-page').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;

            const html = editor.getHtml();
            const css = editor.getCss();
            const components = editor.getComponents().toJSON();

            fetch('{{ route("admin.pages.builder.save", $page->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ html, css, components, styles: [] })
            })
            .then(response => response.json())
            .then(data => {
                btn.innerHTML = originalText;
                btn.disabled = false;
                if(data.success) {
                    alert('Page saved successfully!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.innerHTML = originalText;
                btn.disabled = false;
                alert('An error occurred while saving.');
            });
        });
    </script>
</body>
</html>
