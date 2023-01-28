import "./bootstrap";
import "./bootstrap.bundle.min";
import "./feather.min";
import "./theme";
import "./plugins.init";
import "./jquery-3.3.1.min";
import "./zeynep";
import "./zeynep-right";

/*********************************/
/*         INDEX                 */
/*================================
 *     01.  Sticky header        *
 ================================*/

//=========================================//
/*            01) Stick header             */
//=========================================//

if (document.getElementById("topnav")) {
    let header = document.getElementById("topnav");
    document.addEventListener("scroll", (event) => {
        let scrollY = window.scrollY;

        if (scrollY > 50) {
            header.classList.add("topnavPos");
        } else {
            header.classList.remove("topnavPos");
        }
    });
}

// window.addEventListener("resize", function() {
//     "use strict";
//     window.location.reload();
// });

document.addEventListener("DOMContentLoaded", function () {
    /////// Prevent closing from hover inside dropdown
    document.querySelectorAll(".dropdown-menu").forEach(function (element) {
        element.addEventListener("hover", function (e) {
            e.stopPropagation();
        });
    });

    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {
        // close all inner dropdowns when parent is closed
        document
            .querySelectorAll(".navbar .dropdown")
            .forEach(function (everydropdown) {
                everydropdown.addEventListener(
                    "hidden.bs.dropdown",
                    function () {
                        // after dropdown is hidden, then find all submenus
                        this.querySelectorAll(".megasubmenu").forEach(function (
                            everysubmenu
                        ) {
                            // hide every submenu as well
                            everysubmenu.style.display = "none";
                        });
                    }
                );
            });

        document
            .querySelectorAll(".has-megasubmenu a")
            .forEach(function (element) {
                element.addEventListener("hover", function (e) {
                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList.contains("megasubmenu")) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();

                        if (nextEl.style.display == "block") {
                            nextEl.style.display = "none";
                        } else {
                            nextEl.style.display = "block";
                        }
                    }
                });
            });
    }
    // end if innerWidth
});
// DOMContentLoaded  end
