
@if ($ttlpage > 0)
<ul class="pagination justify-content-center">

            @php if(empty($_GET['page']))$_GET['page']=1; $set=ceil($_GET['page']/5);@endphp
            @php $ppage=($_GET['page']-1); $npage=($_GET['page']+1);@endphp
            
            <li class="page-item @if($_GET['page'] < 2) disabled @endif"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $ppage]) }}" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>

            @php $m = 5; if($ttlpage<5)$m=$ttlpage; @endphp
            
            @php $k=5*($set-1); @endphp
            @for ($i = ($k)+1; $i <= (($k)+5); $i++)
                @if($i<=$ttlpage)
                    @if($i < (($k)+5))
                    <li class="page-item @if($_GET['page'] == $i) active @endif"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{$i}} @if($_GET['page'] == $i)<span class="visually-hidden">(current)</span>@endif</a></li>
                    @endif
                @endif
            @endfor
            
            <li class="page-item @if($_GET['page'] == $ttlpage) disabled @endif"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $npage]) }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
</ul>
@endif