<html>
  <head>
    <title><?php echo $_REQUEST['q'] ?></title>
    
    <style type="text/css">
      <?php include('example.css') ?>
    </style>
  </head>

  <body>
    <div id="wrapper">
      <?php if ( ! empty($errors)): ?>
        <div id="errors">
          <h3>Some Errors Occurred</h3>
          <ul>
            <?php foreach ($errors as $error): ?>
              <li><?php echo $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <div id="keyword">
        <input type="text" id="keyword" name="keyword" value="<?php echo $_REQUEST['q'] ?>" onChange="javascript: location.href = 'example.php?q=' + this.value;" />
      </div>

      <div id="form">
        <form action="example.php?q=<?php echo $_REQUEST['q'] ?>" method="post">
          <div id="username">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" />
          </div>

          <div id="password">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" />
          </div>

          <div id="comment">
            <textarea name="comment" id="comment"></textarea>
          </div>

          <input type="submit" id="button" value="Comment" />
        </form>
      </div>

      <div class="paging">
        <?php if ($previousPage): ?>
          <a href="<?php echo $previousPage ?>" class="previous"><< Previous Page</a>
        <?php endif; ?>
         &nbsp; 
        <?php if ($nextPage): ?>
          <a href="<?php echo $nextPage ?>" class="next">Next Page >></a>
        <?php endif; ?>
      </div>
  
      <?php if (isset($statuses->results)): ?>
        <ul id="tweets">
          <?php foreach ($statuses->results as $status): ?>
            <li>
              <img src="<?php echo $status->profile_image_url ?>" />
              <div><?php echo prepareTweet($status->text) ?></div>
              <small>Posted on <a href="<?php echo $status->source ?>" target="_BLANK"><?php echo date('m/d/Y h:i:s A', strtotime($status->created_at)) ?></a> by <a href="http://www.twitter.com/<?php echo $status->from_user ?>"><?php echo $status->from_user ?></a>.</small>
            </li>
          <?php endforeach ?>
        </ul>
      <?php endif; ?>

      <div class="paging">
        <?php if ($previousPage): ?>
          <a href="<?php echo $previousPage ?>" class="previous"><< Previous Page</a>
        <?php endif; ?>
         &nbsp; 
        <?php if ($nextPage): ?>
          <a href="<?php echo $nextPage ?>" class="next">Next Page >></a>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>