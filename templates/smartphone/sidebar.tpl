<form method="post">
                <input type=hidden name=do value=search>
                <input type="hidden" name="subaction" value="search" />
                <input type="text" name="story" id="searchinput" value="" class="search_input" style="width:150px">
                <input type="submit" class="search_button" name="dosearch" id="dosearch" value="�����" onclick="javascript:list_submit(-1); return false;">
</form>

       <!-- Sidebar Menu-->
       <ul class="sidebar_menu">
          <li class="active"><a style="color: #e8a705;" href="/">������� ������</a></li>
          <li[category=1] class="active"[/category]><a class="head" href="/abstrakciya/">����������</a></li>
          <li[category=2] class="active"[/category]><a class="head" href="/goroda/">������</a></li>
          <li[category=3] class="active"[/category]><a class="head" href="/detskoe/">�������</a></li>
          <li[category=4] class="active"[/category]><a class="head" href="/zhivotnye/">��������</a></li>
          <li[category=48] class="active"[/category]><a class="head" href="/podvodnyy-mir/">��������� ���</a></li>
          <li[category=5] class="active"[/category]><a class="head" href="/kuhnya/">��� �����</a></li>
          <li[category=6] class="active"[/category]><a class="head" href="/lyudi/">����</a></li>
          <li[category=50] class="active"[/category]><a class="head" href="/romantika/">���������</a></li>
          <li[category=7] class="active"[/category]><a class="head" href="/natyurmort/">���������</a></li>
          <li[category=8] class="active"[/category]><a class="head" href="/priroda/">������� � ������</a></li>
          <li[category=10] class="active"[/category]><a class="head" href="/cvety/">�����</a></li>
          <li[category=22] class="active"[/category]><a class="head" href="/kosmos/">������</a></li>
          <li[category=18] class="active"[/category]><a class="head" href="/kino/">����</a></li>
          <li[category=44] class="active"[/category]><a class="head" href="/fentezi/">�������</a></li>
          <li[category=49] class="active"[/category]><a class="head" href="/vintazh/">������</a></li>
          <li[category=15] class="active"[/category]><a class="head" href="/erotika-18/">������� 18+</a></li>
          <li[category=13] class="active"[/category]><a class="head" href="/ruchnaya-rabota/">������� ������ ������</a></li>
          <li[category=11] class="active"[/category]><a class="head" href="/etnika/">������</a></li>
          <li[category=12] class="active"[/category]><a class="head" href="/raznoe/">������</a></li>
       </ul>
       <!-- Sidebar Menu-->
       

       <!-- Sidebar Review -->
       <div class="sidebar_review">
           <div class="sidebar_review_head">������ �����������</div>
           
              {include file="engine/modules/otzivi.php"}
                 
    
       </div>
       <!-- Sidebar Review -->
       
       
        <!-- Just Buy -->
       <div class="justbuy">
           <div class="justbuyhead">�� ��������</div>
        {include file="engine/modules/smotreli.php"}
        
        </div>   
        <!-- Just Buy -->
   
      
       
        <!-- Just Buy -->
       <div class="justbuy">
           <div class="justbuyhead">������ ��� ������</div>
        {include file="engine/modules/kupili.php"}
        
        </div>   
        <!-- Just Buy -->
   
       