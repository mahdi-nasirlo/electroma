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

//=========================================//
/*            02) Mega Menu                */
//=========================================//

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

//=========================================//
/*          03) Equalization card          */
//=========================================//

function equalize(cardName) {
    // Get all the cards
    var cards = document.querySelectorAll(`.${cardName}`);

    // Get the height of the tallest card
    var maxHeight = 0;

    for (var i = 0; i < cards.length; i++) {
        if (cards[i].clientHeight > maxHeight) {
            maxHeight = cards[i].clientHeight;
        }
    }

    // Set the height of all the cards to the height of the tallest card
    for (var i = 0; i < cards.length; i++) {
        cards[i].style.height = maxHeight + "px";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    equalize("product-card");
    equalize("last-post-card");
    equalize("category-banner");
});
