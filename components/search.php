<div id="search_overlay" class="overlay">

    <form method="GET" action="/" class="form-card" id="form" onclick="event.stopPropagation();">

        <div style="display: inline-flex; padding: 10px; justify-content: space-between;">
            <h2 style="text-align: center; margin: 0px;text-decoration: underline;">Search for your next deal</h2>
            <img class="ico-small" onclick="closeCard('search_overlay')" src="resources/x-symbol.svg" alt="close">

        </div>

        <h3 class="heading-label">Search Term:</h3>
        <input type="text" name="search" id="s-box" class="search-box"
            placeholder="Search by Product or Seller">


        <h3 class="heading-label">Filters</h3>

        <div class="filters">

            <div style="text-align: left; margin-left: 10px; margin-bottom: 10px;">
                <label for="min-price">Min Price: R</label>
                <input type="number" name="min-price" id="min-price" class="filter-box" min="1" max="999999" value="1">
            </div>

            <div style="text-align: left; margin-left: 10px;">
                <label for="max-price">Max Price:R</label>
                <input type="number" name="max-price" id="max-price" class="filter-box" min="2" max="100000" value="100000">
            </div>
        </div>
        <br>
        <div style="display: inline-flex; justify-content: space-between;">
            <input type="reset" value="clear" class='clear-button' onclick="">
            <input type="submit" value="Search" class="search-button">
        </div>
    </form>
</div>