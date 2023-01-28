<style type="text/css">
    .megasubmenu {
        padding: 1rem;
    }

    /* ============ desktop view ============ */
    @media all and (min-width: 992px) {
        .megasubmenu {
            right: 100%;
            top: 0;
            min-height: 100%;
            min-width: 500px;
        }

        .dropdown-menu>li:hover .megasubmenu {
            display: block;
        }

        .dropdown-toggle::after {
            content: none;
        }
    }

    /* ============ desktop view .end// ============ */
</style>

<script type="text/javascript">
    // window.addEventListener("resize", function() {
    //     "use strict";
    //     window.location.reload();
    // });


    document.addEventListener("DOMContentLoaded", function() {

        /////// Prevent closing from hover inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function(element) {
            element.addEventListener('hover', function(e) {
                e.stopPropagation();
            });
        });

        // make it as accordion for smaller screens
        if (window.innerWidth < 992) {

            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function() {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.megasubmenu').forEach(function(everysubmenu) {
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
            });

            document.querySelectorAll('.has-megasubmenu a').forEach(function(element) {
                element.addEventListener('hover', function(e) {

                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains('megasubmenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();

                        if (nextEl.style.display == 'block') {
                            nextEl.style.display = 'none';
                        } else {
                            nextEl.style.display = 'block';
                        }

                    }
                });
            })
        }
        // end if innerWidth
    });
    // DOMContentLoaded  end
</script>

<li class="nav-item dropdown has-submenu parent-parent-menu-item">
    <a class="nav-link dropdown-toggle show" aria-expanded="true" href="#" data-bs-toggle="dropdown"
        href="javascript:void(0)">
        فروشگاه </a>
    <span class="menu-arrow"></span>
    <ul class="dropdown-menu submenu show"
        style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(-28.8px, 36px);"
        data-popper-placement="bottom-end">
        @if ($shopCategoies->count() > 0)
            @include('layouts.header.mega-sub-menu-item', [
                'categoreis' => $shopCategoies->toTree(),
            ])
        @endif
    </ul>
</li>
