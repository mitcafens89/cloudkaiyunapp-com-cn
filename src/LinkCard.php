<?php

class LinkCard
{
    private string $url;
    private string $keyword;
    private string $title;
    private string $description;
    private string $domain;

    public function __construct(
        string $url = 'https://www.cloudkaiyunapp.com.cn',
        string $keyword = '开云'
    ) {
        $this->url = $url;
        $this->keyword = $keyword;
        $this->title = $this->generateTitle();
        $this->description = $this->generateDescription();
        $this->domain = parse_url($url, PHP_URL_HOST) ?: 'unknown';
    }

    private function generateTitle(): string
    {
        return $this->keyword . ' - 智能云服务平台';
    }

    private function generateDescription(): string
    {
        return '探索' . $this->keyword . '平台，获取高效、稳定的云端解决方案。';
    }

    public function renderHtml(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8');
        $escapedDesc = htmlspecialchars($this->description, ENT_QUOTES, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES, 'UTF-8');
        $escapedKeyword = htmlspecialchars($this->keyword, ENT_QUOTES, 'UTF-8');

        $html = <<<HTML
<div class="link-card">
    <a href="$escapedUrl" target="_blank" rel="noopener noreferrer" class="link-card-inner">
        <div class="link-card-header">
            <span class="link-card-domain">$escapedDomain</span>
        </div>
        <div class="link-card-body">
            <h3 class="link-card-title">$escapedTitle</h3>
            <p class="link-card-description">$escapedDesc</p>
        </div>
        <div class="link-card-footer">
            <span class="link-card-keyword">关键词: $escapedKeyword</span>
        </div>
    </a>
</div>
HTML;
        return $html;
    }

    public static function createWithDefaultData(): self
    {
        return new self(
            'https://www.cloudkaiyunapp.com.cn',
            '开云'
        );
    }
}

function renderLinkCard(
    string $url = 'https://www.cloudkaiyunapp.com.cn',
    string $keyword = '开云'
): string {
    $card = new LinkCard($url, $keyword);
    return $card->renderHtml();
}

function renderLinkCards(array $cardsData): string
{
    $output = '';
    foreach ($cardsData as $data) {
        $url = $data['url'] ?? 'https://www.cloudkaiyunapp.com.cn';
        $keyword = $data['keyword'] ?? '开云';
        $output .= renderLinkCard($url, $keyword) . "\n";
    }
    return $output;
}

$sampleCards = [
    [
        'url' => 'https://www.cloudkaiyunapp.com.cn',
        'keyword' => '开云'
    ],
    [
        'url' => 'https://www.cloudkaiyunapp.com.cn/about',
        'keyword' => '开云关于我们'
    ],
    [
        'url' => 'https://www.cloudkaiyunapp.com.cn/contact',
        'keyword' => '开云联系方式'
    ]
];

$renderedPages = renderLinkCards($sampleCards);
echo $renderedPages;