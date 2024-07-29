
    async function fetchLeaders() {
        try {
            const response = await fetch('/club/Admin/controller/fetchleaders.php'); // Ensure the path is correct
            const leaders = await response.json();
            const container = document.getElementById('leaders-container');
            
            if (leaders.length > 0) {
                leaders.forEach(leader => {
                    const col = document.createElement('div');
                    col.className = 'col-lg-4 col-md-6';
                    col.innerHTML = `
                        <div class="speaker">
                            <img src="/club/Admin/pages/${leader.photo}" alt="Speaker" class="img-fluid">
                            <div class="details">
                                <h3><a href="speaker-details.html">${leader.leadername}</a></h3>
                                <p>${leader.role}</p>
                               
                            </div>
                        </div>
                    `;
                    container.appendChild(col);
                });
            } else {
                container.innerHTML = "<p>No leaders found.</p>";
            }
        } catch (error) {
            console.error('Error fetching leaders:', error);
            document.getElementById('leaders-container').innerHTML = "<p>Error fetching leaders.</p>";
        }
    }


    async function fetchWeImages() {
        try {
            const response = await fetch('/club/Admin/controller/fetchweimage.php'); // Ensure the path is correct
            const weImages = await response.json();

            const galleryRow = document.getElementById('gallery-row');
            
            if (weImages.length > 0) {
                weImages.forEach(image => {
              //      console.log(image)
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-lg-3 col-md-4';
                    
                    const venueGalleryDiv = document.createElement('div');
                    venueGalleryDiv.className = 'venue-gallery';
                    
                    const anchor = document.createElement('a');
                    anchor.href = `/club/Admin/pages/${image.photo}`;
                    anchor.className = 'venobox';
                    anchor.setAttribute('data-gall', 'venue-gallery');
                    
                    const img = document.createElement('img');
                    
                    img.src = `/club/Admin/pages/${image.photo}`;
                    img.alt = '';
                    img.className = 'img-fluid';
                    
                    anchor.appendChild(img);
                    venueGalleryDiv.appendChild(anchor);
                    colDiv.appendChild(venueGalleryDiv);
                    galleryRow.appendChild(colDiv);
                });
            } else {
                galleryRow.innerHTML = "<p>No images found.</p>";
            }
        } catch (error) {
            console.error('Error fetching images:', error);
            document.getElementById('gallery-row').innerHTML = "<p>Error fetching images.</p>";
        }
    }
    
    async function fetchGalleryImages() {
        try {
            const response = await fetch('/club/Admin/controller/fetchgallery.php'); // Ensure the path is correct
            const galleryImages = await response.json();
    
            const galleryCarousel = document.getElementById('gallery-carousel');
            if (!galleryCarousel) {
                throw new Error("Gallery carousel element not found");
            }
    
            if (galleryImages.length > 0) {
                galleryImages.forEach(image => {
                    const anchor = document.createElement('a');
                    anchor.href = `/club/Admin/pages/${image.photo}`;
                    anchor.className = 'venobox';
                    anchor.setAttribute('data-gall', 'gallery-carousel');
                    
                    const img = document.createElement('img');
                    img.src = `/club/Admin/pages/${image.photo}`;
                    img.alt = '';
    
                    anchor.appendChild(img);
                    galleryCarousel.appendChild(anchor);
                });
    
                startCarousel();
            } else {
                galleryCarousel.innerHTML = "<p>No images found.</p>";
            }
        } catch (error) {
            console.error('Error fetching gallery images:', error);
            document.getElementById('gallery-carousel').innerHTML = "<p>Error fetching gallery images.</p>";
        }
    }
    
    function startCarousel() {
        const carousel = document.getElementById('gallery-carousel');
        let index = 0;
    
        setInterval(() => {
            index = (index + 1) % carousel.children.length;
            carousel.style.transform = `translateX(-${index * 100}%)`;
        }, 3000); // Change image every 3 seconds
    }
    
    document.addEventListener('DOMContentLoaded', fetchGalleryImages);
    
    async function fetchSponsors() {
        try {
            const response = await fetch('/club/Admin/controller/fetchSponsors.php'); // Ensure the path is correct
            const sponsors = await response.json();
            console.log(sponsors);
    
            const sponsorsContainer = document.getElementById('sponsors-container');
            if (!sponsorsContainer) {
                throw new Error("Sponsors container element not found");
            }
    
            if (sponsors.length > 0) {
                sponsors.forEach(sponsor => {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-lg-3 col-md-4 col-xs-6';
                    
                    const sponsorLogoDiv = document.createElement('div');
                    sponsorLogoDiv.className = 'sponsor-logo';
                    
                    const img = document.createElement('img');
                    img.src = `/club/Admin/pages/${sponsor.photo}`;
                    img.className = 'img-fluid';
                    img.alt = sponsor.name;
    
                    sponsorLogoDiv.appendChild(img);
                    colDiv.appendChild(sponsorLogoDiv);
                    sponsorsContainer.appendChild(colDiv);
                });
            } else {
                sponsorsContainer.innerHTML = "<p>No sponsors found.</p>";
            }
        } catch (error) {
            console.error('Error fetching sponsors:', error);
            document.getElementById('sponsors-container').innerHTML = "<p>Error fetching sponsors.</p>";
        }
    }
    
    
   


     


