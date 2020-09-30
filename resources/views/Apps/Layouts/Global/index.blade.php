<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title_for_layout) ? $title_for_layout : ''; ?></title>
        @include('Apps.Layouts.Global.Includes.index.include_meta')
        @include('Apps.Layouts.Global.Includes.index.include_css') 
    </head>
    <body>
        @include('Apps.Layouts.Global.Includes.index.notif') 
        <div class="perspective effect-rotate-left">
            <div class="container"><div class="outer-nav--return"></div>
                <div id="viewport" class="l-viewport">
                    <div class="l-wrapper">
                        @include('Apps.Elements.Global.header') 
                        @include('Apps.Elements.Global.navbar') 
                        <?php if ($_path_content_app): ?>
                            @include("{$_path_content_app}")
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            @include('Apps.Elements.Global.menu') 
        </div>
        @include('Apps.Layouts.Global.Includes.index.include_js') 
    </body>
</html>