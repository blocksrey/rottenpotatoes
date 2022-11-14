function categRate(id, category) { document.forms.modalCateg.action = "mymovies.php?id="+id+"&url=categories.php?category="+category.value; }
function listsRate(id, string) { document.forms.modalList.action = "mymovies.php?id="+id+"&url=watchlist.php#"+string; }
function ranksRate(id, string) { document.forms.modalRank.action = "mymovies.php?id="+id+"&url=ranking.php#"+string; }
function resultsRate(id, string) { document.forms.modalResult.action = "mymovies.php?id="+id+"&url=results.php?search="+string; }
function homeRate(id, string) { document.forms.modalHome.action = "mymovies.php?id="+id+"&url=home.php#"+string; }








