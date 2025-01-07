<?php

/**
 * 检查用户是否登录
 */
function checkLogin(): bool
{
    session_start();
    if (empty($_SESSION['user'])) {
        return false;
    }
    return true;
}

/**
 * 消息提示
 * @param int $type 1:成功 2:失败
 * @param null $msg
 * @param null $url
 */
function msg(int $type, $msg = null, $url = null)
{
    ob_start(); //开启输出缓存，确保在调用header函数之前没有任何输出

    // 假设要跳转到的页面是 target.php，并且要传递参数 param1、param2和param3
    $param1 = urlencode($type); //此函数便于将字符串编码并将其用于 URL 的请求部分，同时它还便于将变量传递给下一页。
    $param2 = urlencode($msg);
    $param3 = urlencode($url);

    $targetUrl = "msg.php?type=" . $param1 . "&msg=" . $param2 . "&url=" . $param3;
    // 进行页面跳转
    // Location是HTTP响应头的一部分，告诉浏览器跳转到指定的url
    header('Location:' . $targetUrl);
    exit; //终止脚本的执行，避免后续代码的执行影响重定向操作
}

/**
 * 获取当前url
 * @return string
 */
function getUrl(): string
{
    $url = '';
    $url .= $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    return $url;
}


/**
 * 根据page生成url
 * @param $page
 * @param string $url
 * @return string
 */
function pageUrl($page, string $url = ''): string
{
    $url = empty($url) ? getUrl() : $url;
    //查询url中是否存在?
    $pos = strpos($url, '?');
    if ($pos === false) {
        $url .= '?page=' . $page;
    } else {
        $queryString = substr($url, $pos + 1);
        //解析querystring为数组
        parse_str($queryString, $queryArr);
        if (isset($queryArr['page'])) {
            unset($queryArr['page']);
        }
        $queryArr['page'] = $page;

        //将queryArr重新拼接成queryString
        $queryStr = http_build_query($queryArr);
        $url = substr($url, 0, $pos) . '?' . $queryStr;

    }
    return $url;
}


/**
 * 分页显示
 * @param int $total 数据总数
 * @param int $currentPage 当前页
 * @param int $pageSize 每页显示条数
 * @param int $show 显示按钮数
 * @return string
 */
function pages(int $total, int $currentPage, int $pageSize, int $show = 6): string
{
    $pageStr = '';
    //仅当总数大于每页显示条数 才进行分页处理
    if ($total > $pageSize) {
        // 总页数
        $totalPage = ceil($total / $pageSize); //向上取整 获取总页数
        // 对当前页进行处理
        $currentPage = $currentPage > $totalPage ? $totalPage : $currentPage;
        // 分页起始页
        $from = max(1, ($currentPage - intval($show / 2)));
        // 分页结束页
        $to = $from + $show - 1;

        $pageStr .= '<ul class="pagination">';

        //仅当 当前页大于1的时候 存在 首页和上一页按钮
        if ($currentPage > 1) {
            $pageStr .= "<li><a href='" . pageUrl(1) . "'>首页</a></li>";
            $pageStr .= "<li><a href='" . pageUrl($currentPage - 1) . "'>上一页</a></li>";
        }

        // 当结束页大于总页
        if ($to > $totalPage) {
            $to = $totalPage;
            $from = max(1, $to - $show + 1);
        }

        if ($from > 1) {
            $pageStr .= '<li><a>...</a></li>';
        }

        for ($i = $from; $i <= $to; $i++) {
            if ($i != $currentPage) {
                $pageStr .= "<li><a href='" . pageUrl($i) . "'>{$i}</a></li>";
            } else {
                $pageStr .= "<li><span class='curr-page'>{$i}</span></li>";
            }
        }

        if ($to < $totalPage) {
            $pageStr .= '<li><a>...</a></li>';
        }

        if ($currentPage < $totalPage) {
            $pageStr .= "<li><a href='" . pageUrl($currentPage + 1) . "'>下一页</a></li>";
            $pageStr .= "<li><a href='" . pageUrl($totalPage) . "'>尾页</a></li>";
        }
        $pageStr .= '</ul>';


    }
    return $pageStr;

}
