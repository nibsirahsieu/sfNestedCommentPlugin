<?php
function comment_pagination($pager, $uri, $sf_params, $prev_text = 'Previous', $next_text = 'Next', $sort = 'desc')
{
  $navigation = '';
  if ($pager->haveToPaginate()) {
    $prms = array();
    if (null !== $sf_params && $sf_params instanceof sfParameterHolder) {
      $prms = array_merge($sf_params->getAll(), $prms);
      unset($prms['module'], $prms['action'], $prms['page']);
    }
    $uri .= '?comment-page=';

    $navigation .= '<div class="navigation">';
    if ($sort == 'asc')
    {
      if ($pager->getPage() != 1) {
        $navigation .= '<div class="nav-previous"><span class="meta-nav">&larr;</span><a class="comment-link" href="'.formatUrlFromParameters($uri.$pager->getPreviousPage(), $prms).'">'.__($prev_text).'</a></div>';
      }
      if ($pager->getPage() != $pager->getLastPage()) {
        $navigation .= '<div class="nav-next"><a class="comment-link" href="'.formatUrlFromParameters($uri.$pager->getNextPage(), $prms).'">'.__($next_text).'</a><span class="meta-nav">&rarr;</span></div>';
      }
    }
    else
    {
      if ($pager->getPage() != 1) {
      $navigation .= '<div class="nav-next"><a class="comment-link" href="'.formatUrlFromParameters($uri.$pager->getPreviousPage(), $prms).'">'.__($next_text).'</a><span class="meta-nav">&rarr;</span></div>';
      }
      if ($pager->getPage() != $pager->getLastPage()) {
        $navigation .= '<div class="nav-previous"><span class="meta-nav">&larr;</span><a class="comment-link" href="'.formatUrlFromParameters($uri.$pager->getNextPage(), $prms).'">'.__($prev_text).'</a></div>';
      }
    }
    $navigation .= '</div>';
  }
  return $navigation;
}

function formatUrlFromParameters($uri, $prms)
{
  $url = url_for($uri);
  if (count($prms) > 0)
  {
    $url = url_for($url)."?".http_build_query($prms, '', '&');
  }
  return $url;
}
