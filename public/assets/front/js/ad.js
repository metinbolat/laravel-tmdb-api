
            const skipButton = document.getElementById('skip-button');
            const adContainer = document.getElementById('ad');
            const videoContainer = document.getElementById('video');
            skipButton.addEventListener('click', function() {
            adContainer.style.display = 'none';
            videoContainer.style.display = 'block';
      });
      setTimeout(function(){
        skipButton.style.display = 'block';
      }, 5000);
      const closeBtn = document.getElementById('close-btn');
      const adDiv = document.getElementById('ad-div');
      closeBtn.addEventListener('click', function() {
        adDiv.style.display = 'none';
      });
      