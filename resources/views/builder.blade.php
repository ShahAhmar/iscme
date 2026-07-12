<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visual Page Builder - ISCME 2027</title>
    <!-- GrapesJS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.2/css/grapes.min.css">
    <style>
        body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; }
        #gjs { border: 3px solid #444; }
        /* Panel style */
        .panel__top {
            padding: 0;
            width: 100%;
            display: flex;
            position: initial;
            justify-content: center;
            justify-content: space-between;
            background: #2a2a2a;
        }
        .panel__basic-actions {
            position: initial;
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
        </div>
        <div>
            <span style="color: white; margin-right: 15px;">Editing: {{ $page->title }}</span>
            <button id="save-page" class="admin-bar-btn">Save Changes</button>
        </div>
    </div>
    
    <div id="gjs"></div>

    <!-- GrapesJS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.21.2/grapes.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs-blocks-basic/1.0.1/grapesjs-blocks-basic.min.js"></script>
    
    <script>
        const editor = grapesjs.init({
            container: '#gjs',
            fromElement: true,
            height: 'calc(100vh - 45px)',
            width: 'auto',
            storageManager: false,
            plugins: ['gjs-blocks-basic'],
            pluginsOpts: {
                'gjs-blocks-basic': { flexGrid: true }
            }
        });

        // Load existing page data if available
        const existingComponents = {!! $page->components && $page->components !== '[]' ? $page->components : 'null' !!};
        const existingStyles = {!! $page->styles && $page->styles !== '[]' ? $page->styles : 'null' !!};
        
        if (existingComponents) {
            editor.setComponents(existingComponents);
            if(existingStyles) editor.setStyle(existingStyles);
        } else {
            const existingHtml = `{!! addslashes($page->html ?? '') !!}`;
            const existingCss = `{!! addslashes($page->css ?? '') !!}`;
            if(existingHtml) {
                editor.setComponents(existingHtml);
                if(existingCss) editor.setStyle(existingCss);
            }
        }

        // Handle Save
        document.getElementById('save-page').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;

            const html = editor.getHtml();
            const css = editor.getCss();
            const components = editor.getComponents();
            const styles = editor.getStyle();

            fetch('{{ route("admin.pages.builder.save", $page->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ html, css, components, styles })
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
