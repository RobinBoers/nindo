<!--
<style>
    .stemming {
        float: left;
        width: 30%;
        padding-top: 10px;
        padding-bottom: 8px;
    }
    .newbericht {
        float: right;
        width: 68%;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .newbericht *, .stemming * {
        width: 100%;
    }
    .okbutton {
        margin-top: 10px;
    }
</style>
-->
<ons-list>
    <ons-list-header>Bericht plaatsen:</ons-list-header>
<!-- Hij wordt naar zichzelf verstuurt en door een script onderaan deze pagina verwerkt en naar postblog.php gestuurd -->
<form method="post" name="blogpost" action="../post.php" class="clearfix">
    
    <p>Stemming: 
    <select name="stemming">
      <option value="vrolijk">Vrolijk</option>
      <option value="blij">Blij</option>
      <option value="boos">Boos</option>
      <option value="verdrietig">Verdrietig</option>
      <option value="ge&iuml;rriteerd">ge&iuml;rriteerd</option>
      <option value="ge&iuml;nteresseerd">ge&iuml;nteresseerd</option>
    </select></p>

    <textarea style="width:100%;height:200px;resize:none;" name="text" id="text"></textarea><br>
    <input name="image" type="hidden" value="">
    <input class="okbutton" name="submit" type="submit" value="Oke">
</form>
</ons-list>
