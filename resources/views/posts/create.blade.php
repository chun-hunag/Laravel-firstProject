新增文章

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <label>內容：
        <textarea name="content"></textarea>
    </label><br>
    <input type="submit" value="送出文章">
</form>