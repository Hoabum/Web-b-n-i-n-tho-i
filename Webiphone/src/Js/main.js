function getTime(dealine) {
    const dealineDate = new Date(dealine);
    const now = new Date();
    /// khoang cách giữa 2 ngày 
    const distant = (dealineDate - now) / 1000 //giay

    // days
    const days = Math.floor(distant / 3600 / 24);
    // hours
    const hours = Math.floor(distant / 3600) % 24
        /// minutes
    const minites = Math.floor(distant / 60) % 60
        // seconds
    const seconds = Math.floor(distant) % 60;

    //render html
    $(".time-days").text(days);
    $(".time-hours").text(hours);
    $(".time-mins").text(minites);
    $(".time-secs").text(seconds);

}

setInterval(() => {
    getTime("2022/09/01")
}, 1000);

// totop

$(window).scroll(function() {
    //lấy kích thước hiện tại 
    const current = $(this).scrollTop();

    if (current > 200) {
        $(".totop").addClass("fixed");
    } else {
        $(".totop").removeClass("fixed");
    }
});

// click 
$(".totop").click(function(e) {
    e.preventDefault();
    $("body,html").animate({
        scrollTop: 0,
    })
});


$(document).ready(function() {

    $(".baohanh").click(function(e) {
        $(".product-content-right-bottom-content-chitiet").css('display', 'none');
        $(".product-content-right-bottom-content-baohanh").css('display', 'block');

        $(".p-chitiet").removeClass("product");
        $(".p-baohanh").addClass("product");
    });
    $(".chitiet").click(function(e) {
        $(".product-content-right-bottom-content-baohanh").css('display', 'none');
        $(".product-content-right-bottom-content-chitiet").css('display', 'block');
        $(".p-baohanh").removeClass("product");
        $(".p-chitiet").addClass("product");
    });
    var count = 0;
    $(".product-content-right-bottom-top").click(function(e) {
        count++;
        if (count % 2 != 0) {
            $(".product-content-right-bottom-content-big").css('display', 'none');

            $(".product-content-right-bottom-top").addClass("reverse");
        } else {
            $(".product-content-right-bottom-content-big").css('display', 'block');
            $(".product-content-right-bottom-top").removeClass("reverse");

        }

    });
});


//click img
const bigImg = document.querySelector(".product-content-left-img img")
const smalImg = document.querySelectorAll(".small-img-group img")
smalImg.forEach(function(imgItem, X) {
    imgItem.addEventListener("click", function() {
        bigImg.src = imgItem.src

    })
});


/// zoom img
const container = document.querySelector(".product-content-left-img")
const image = document.querySelector(".img")
const lens = document.querySelector(".lens")
const result = document.querySelector(".result")

const containerRect = container.getBoundingClientRect()
const imageRect = image.getBoundingClientRect()
const lensRect = lens.getBoundingClientRect()
const resultRect = result.getBoundingClientRect()

container.addEventListener("mousemove", zoomImage)

result.style.backgroundImage = `url(${image.src})`

function zoomImage(e) {
    console.log("zoom image", e.clientX, e.clientY)
    const { x, y } = getMousePos(e)

    lens.style.left = x + "px"
    lens.style.top = y + "px"

    let fx = resultRect.width / lensRect.width
    let fy = resultRect.height / lensRect.height

    result.style.backgroundSize = `${imageRect.width * fx}px ${
        imageRect.height * fy
    }px`
    result.style.backgroundPosition = `-${x * fx}px -${y * fy}px`
}

function getMousePos(e) {
    let x = e.clientX - containerRect.left - lensRect.width / 2
    let y = e.clientY - containerRect.top - lensRect.height / 2

    let minX = 0
    let minY = 0
    let maxX = containerRect.width - lensRect.width
    let maxY = containerRect.height - lensRect.height

    if (x <= minX) {
        x = minX
    } else if (x >= maxX) {
        x = maxX
    }
    if (y <= minY) {
        y = minY
    } else if (y >= maxY) {
        y = maxY
    }

    return { x, y }
}