import "./bootstrap";
import "./bootstrap.bundle.min";
import "./feather.min";
import "./theme";
import "./plugins.init";
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
