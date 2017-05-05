<footer id="footer" class="">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 unswLinks">
                <a href="http://www.unsw.edu.au/gen/pad/privacy.html">Privacy Policy</a>
                <a href="http://www.unsw.edu.au/gen/pad/copyright.html">Copyright & Disclaimer</a>
                <a href="http://www.unsw.edu.au/accessibility" class="last" >Accessibillity</a>
            </div>
            
            
            
            <div class="col-xs-12 col-sm-6">
            <h3>Connect with BLUEsat:</h3>
            <a class="facebook-share-footer share-footer" itemprop="sameAs" href="https://www.facebook.com/bluesat.unsw"></a>
            <a class="linkedin-share-footer share-footer" itemprop="sameAs" href="https://www.linkedin.com/company/bluesat-unsw"></a>
            <a class="google-share-footer share-footer" itemprop="sameAs" href="https://plus.google.com/+BLUEsatAuUNSW"></a>
            <a class="email-share-footer share-footer" itemprop="email" href="mailto:info@bluesat.com.au"></a>
            <link itemprop="sameAs" href="https://twitter.com/UNSW_BLUEsat"/>
            <link itemprop="sameAs" href="https://www.youtube.com/channel/UCadkhouFQxziUEMCMLlK9aw"/>
            <link itemprop="sameAs" href="https://en.wikipedia.org/wiki/BLUEsat_UNSW"/>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <span itemprop="streetAddress">BLUEsat UNSW, Electrical Engineering Building, UNSW</span>,
                <span itemprop="addressLocality">Sydney</span> <span itemprop="addressRegion">NSW</span> 
                <span itemprop="postalCode">2052</span>, <span itemprop="addressCountry">Australia</span>
                </address>
                Authorised by President, BLUEsat Group, UNSW,<br/>
                Provider Code: <em>00098G</em> 
                ABN: <em itemprop="taxID">57 195 873 179</em>
                <p >
                Last Updated: <?php the_modified_date()?>
                </p>
            </div>
            <div class="col-xs-12 col-sm-6">
                 <h3>BLUEsat is proudly sponsored by:</h3>
            <p class="sponsors">
                <?php
                    print_sponsors("sponsors");
                ?>
            </p>
            </div>
        </div>
    </div>
</footer>
</main>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70823030-2', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>