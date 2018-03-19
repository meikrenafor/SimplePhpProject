<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article Editor</title>
    <link rel="stylesheet" href='/css/normalize.css' >
    <link rel="stylesheet" href='/css/bootstrap.min.css' >
    <link rel="stylesheet" href='/css/common-styles.css' >
</head>
<body>
<h1 class="text-center">Article Editor</h1>
<div class="container">
    <form name='articleChangesForm' method='POST' action="/Controllers/ArticleChangesUpdaterController.php">
        <input name="id" type="hidden" value="<?=$id?>">
        <label class='col-md-12 form-group'>
            <h3>Article Title:</h3>
            <input class="form-control" name="title" type="text" value="<?=$articleTitle?>">
        </label>
        <label class='col-md-12 form-group'>
            <h3>Article Text:</h3>
            <textarea class="form-control" name="text" type="text" rows="6"><?=$articleText?></textarea>
        </label>
        <div class='form-group col-md-12'>
            <button class="btn btn-default button" type="submit">
                <a>Submit</a>
            </button>
            <button class="btn btn-default button">
                <a href='/Models/ArticleEditorModel.php?action=delete&id=<?=$id?>'
                   onclick="return confirm('Are you sure?')">Delete</a>
            </button>
        </div>
    </form>
</div>
</body>
