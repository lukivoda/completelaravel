<table   class="table table-hover">
    <thead>
    <tr>
        <th>featured image</th>
        <th>category</th>
        <th>title</th>
        <th>tags</th>
    </tr>
    </thead>
    <tbody id="postBox" >

    @foreach($posts as $post)
        <tr >
            <td ><img  width="60" height="40" src="{{asset('images/'.$post->featured)}}" alt=""></td>
            <td>{{$post->category->name}}</td>
            <td>{{$post->title}}</td>
            <td>
                @foreach($post->tags as $tag)
                    <span style="cursor: auto !important;" class="btn btn-info btn-xs">{{$tag->name}}</span>
                @endforeach
            </td>
            <td ><a  data-target="#myModalUpdate" data-toggle="modal"  data-id="{{$post->id}}" class="btn btn-warning btn-sm updateBtn"  href="#">Update</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $posts->render() !!}