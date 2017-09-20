<?php 
foreach($result as $user) :?>
    
<div id='profile' style="border: 1px solid #FFB2B2; padding-top: 1em; padding-left: 1em; padding-bottom: 1.5em;">
        <img id='profilbild' src='images/profile.png' width='100px'>
            <div id='content' class='searchname'>
                <a class='name' href="/profile?userId=<?=$user->id?>"><?=$user->username?></a><br><br>
                <p class='status'><?=$user->status ?></p>
                <h3><?=$user->followersCount?> Follower</h3>
            </div>
</div>
<br>
<br>

<?php endforeach;?>