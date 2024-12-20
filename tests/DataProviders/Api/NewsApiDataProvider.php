<?php

namespace Tests\DataProviders\Api;

final class NewsApiDataProvider
{
    public static function getApiData()
    {
        return [
            "status" => "ok",
            "totalResults" => 37,
            // There are 20 articles here with 2 'removed.com'
            "articles" => [
                [
                    "source" => [
                        "id" => "the-wall-street-journal",
                        "name" => "The Wall Street Journal"
                    ],
                    "author" => "The Wall Street Journal",
                    "title" => "Israel’s Expanded Perch on Syrian Border Puts Damascus in Its Sights - The Wall Street Journal",
                    "description" => null,
                    "url" => "https://www.wsj.com/world/middle-east/israels-expanded-perch-on-syrian-border-puts-damascus-in-its-sights-bed2d218",
                    "urlToImage" => null,
                    "publishedAt" => "2024-12-20T07:48:00Z",
                    "content" => null
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "NBCSports.com"
                    ],
                    "author" => "Myles Simmons",
                    "title" => "Jim Harbaugh => Free-kick field goal is \"my favorite rule in football\" - NBC Sports",
                    "description" => "Before Cameron Dicker's successful 57-yarder, the last time a team attempted a fair-catch kick was the Panthers in 2019.",
                    "url" => "https://www.nbcsports.com/nfl/profootballtalk/rumor-mill/news/jim-harbaugh-free-kick-field-goal-is-my-favorite-rule-in-football",
                    "urlToImage" => "https://nbcsports.brightspotcdn.com/dims4/default/ccfd614/2147483647/strip/true/crop/4857x2732+0+0/resize/1440x810!/quality/90/?url=https%3A%2F%2Fnbc-sports-production-nbc-sports.s3.us-east-1.amazonaws.com%2Fbrightspot%2F1c%2Fb8%2F00cc7c3b43e885dce12a92a54961%2Fhttps-delivery-gettyimages.com%2Fdownloads%2F2190319955",
                    "publishedAt" => "2024-12-20T06:05:23Z",
                    "content" => "Before Cameron Dickers successful 57-yarder, the last time a team attempted a fair-catch kick was the Panthers in 2019. Joey Slye had a 60-yard attempt during a London game.\r\nBut before that, 49ers k… [+1922 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "[Removed]"
                    ],
                    "author" => null,
                    "title" => "[Removed]",
                    "description" => "[Removed]",
                    "url" => "https://removed.com",
                    "urlToImage" => null,
                    "publishedAt" => "2024-12-20T05:00:00Z",
                    "content" => "[Removed]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "CBS Sports"
                    ],
                    "author" => "",
                    "title" => "Draymond Green makes embarrassing NBA history as Warriors suffer 51-point blowout loss to Grizzlies - CBS Sports",
                    "description" => "Green played 19 minutes without scoring a point or even registering a single rebound or assist",
                    "url" => "https://www.cbssports.com/nba/news/draymond-green-makes-embarrassing-nba-history-as-warriors-suffer-51-point-blowout-loss-to-grizzlies/",
                    "urlToImage" => "https://sportshub.cbsistatic.com/i/r/2024/12/20/6c4e738f-9f28-4787-83e9-3318d86fc96a/thumbnail/1200x675/ded9dafa4d4e3f112e9b8dc10d5a2677/draymond.png",
                    "publishedAt" => "2024-12-20T04:43:00Z",
                    "content" => "Let's say you were trying to script the absolute worst game Draymond Green could possibly have. Obviously, it would be a blowout loss for the Golden State Warriors. His stat line -- always vulnerable… [+2819 chars]"
                ],
                [
                    "source" => [
                        "id" => "reuters",
                        "name" => "Reuters"
                    ],
                    "author" => "Nicoco Chan, Tyrone Siu",
                    "title" => "China's Xi urges bigger international role for gambling hub Macau - Reuters",
                    "description" => "China's President Xi Jinping urged Macau's new government to have the \"courage\" to diversify the economy of the world's biggest gambling hub as the former Portuguese enclave swore in its first city leader born and raised in mainland China.",
                    "url" => "https://www.reuters.com/world/china/chinas-xi-urges-bigger-international-role-gambling-hub-macau-2024-12-20/",
                    "urlToImage" => "https://www.reuters.com/resizer/v2/NZCPSLQWVZLYPH3MF74K4XHFEM.jpg?auth=964a0668c89a5fd97259eeb71d9726374ed029ea63e56944cf4ebcf08a466d13&height=1005&width=1920&quality=80&smart=true",
                    "publishedAt" => "2024-12-20T04:20:00Z",
                    "content" => null
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "Mile High Report"
                    ],
                    "author" => "Tim Lynch",
                    "title" => "Week 16 => Broncos at Chargers - Live Coverage - Mile High Report",
                    "description" => "Come join us to discuss tonight’s Thursday Night Football game between the Denver Broncos and Los Angeles Chargers in Week 16.",
                    "url" => "https://www.milehighreport.com/2024/12/19/24325486/week-16-broncos-vs-chargers-live-coverage-tnf",
                    "urlToImage" => "https://cdn.vox-cdn.com/thumbor/d0BwarJNTgO9Z2ykM0X6maqPk5Q=/0x0:3936x2061/fit-in/1200x630/cdn.vox-cdn.com/uploads/chorus_asset/file/25749588/usa_today_24483930.jpg",
                    "publishedAt" => "2024-12-20T04:02:27Z",
                    "content" => "UPDATE:Final score is 34-27. Broncos fall to 9-6.\r\nThe Denver Broncos will square off on the road against the Los Angeles Chargers on Thursday Night Football tonight. The winner of this game will put… [+4980 chars]"
                ],
                [
                    "source" => [
                        "id" => "the-washington-post",
                        "name" => "The Washington Post"
                    ],
                    "author" => "Patrick Marley, Hannah Natanson, Sarah Blaskey",
                    "title" => "California man detained on suspicion of ‘plotting’ with Wisconsin school shooter - The Washington Post",
                    "description" => "FBI agents interviewed Alexander Paffendorf, 20, late Tuesday, according to a court order obtained by The Washington Post.",
                    "url" => "https://www.washingtonpost.com/nation/2024/12/19/wisconsin-school-shooting-plot-california-arrest/",
                    "urlToImage" => "https://www.washingtonpost.com/wp-apps/imrs.php?src=https://arc-anglerfish-washpost-prod-washpost.s3.amazonaws.com/public/YQVD32KXK67U5GMQE2IZJS7MW4_size-normalized.jpg&w=1440",
                    "publishedAt" => "2024-12-20T03:40:32Z",
                    "content" => "MADISON, Wisconsin Authorities have detained a California man on suspicion of plotting a mass shooting with the 15-year-old girl who opened fire in her small Christian school in Wisconsin this week, … [+3936 chars]"
                ],
                [
                    "source" => [
                        "id" => "the-washington-post",
                        "name" => "The Washington Post"
                    ],
                    "author" => "Fenit Nirappil",
                    "title" => "What to know about the bird flu outbreak as concerns about U.S. cases grow - The Washington Post",
                    "description" => "The H5N1 strains are becoming more concerning as the first severe U.S. case has been detected and California declared a state of emergency.",
                    "url" => "https://www.washingtonpost.com/health/2024/12/19/bird-flu-outbreak-symptoms-vaccine-explained/",
                    "urlToImage" => "https://www.washingtonpost.com/wp-apps/imrs.php?src=https://arc-anglerfish-washpost-prod-washpost.s3.amazonaws.com/public/KBNLMG5O247CL66KYPPFAZI6PM_size-normalized.jpg&w=1440",
                    "publishedAt" => "2024-12-20T03:23:58Z",
                    "content" => "The bird flu outbreak in the United States is becoming more concerning after California declared a state of emergency to confront the spread in dairy cows and Louisiana reported the first severe illn… [+293 chars]"
                ],
                [
                    "source" => [
                        "id" => "axios",
                        "name" => "Axios"
                    ],
                    "author" => "Erin Doherty, Avery Lotz",
                    "title" => "Fani Willis disqualified from Trump's Georgia election interference case - Axios",
                    "description" => "It's another major legal victory for the president-elect.",
                    "url" => "https://www.axios.com/2024/12/19/fani-willis-disqualified-trump-2020-case",
                    "urlToImage" => "https://images.axios.com/tklP5johl5s-JEz_Q-hznJpcnXE=/0x0:6000x3375/1366x768/2024/12/19/1734619251323.jpg",
                    "publishedAt" => "2024-12-20T03:07:33Z",
                    "content" => "The Georgia Court of Appeals ruled Thursday to disqualify Fulton County District Attorney Fani Willis from President-elect Trump's state 2020 election interference case over a conflict of interest. \r… [+2987 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "New York Post"
                    ],
                    "author" => "Sean Mandell",
                    "title" => "Wendy Williams cries at son's college graduation, rides scooter in rare public appearance as she battles dementia - New York Post ",
                    "description" => "A tearful moment for mama Wendy.",
                    "url" => "https://nypost.com/2024/12/19/entertainment/wendy-williams-cries-at-sons-college-graduation-rides-scooter-in-rare-public-appearance-as-she-battles-dementia/",
                    "urlToImage" => "https://nypost.com/wp-content/uploads/sites/2/2024/12/95625537.jpg?quality=75&strip=all&w=1024",
                    "publishedAt" => "2024-12-20T02:36:00Z",
                    "content" => "One proud mama. \r\nWendy Williams got emotional as she attended her son’s college graduation on Thursday in a rare outing as she battles early-onset dementia. \r\nWearing a sparkly dress and Chanel shoe… [+3546 chars]"
                ],
                [
                    "source" => [
                        "id" => "politico",
                        "name" => "Politico"
                    ],
                    "author" => "Olivia Beavers, Jordain Carney",
                    "title" => "Johnson on shaky ground with Trump after spending fiasco - POLITICO",
                    "description" => "Months of working to get the president-elect on his side didn’t fully protect the speaker from the president’s wrath over a funding bill.",
                    "url" => "https://www.politico.com/news/2024/12/19/johnson-shaky-ground-trump-spending-fiasco-00195512",
                    "urlToImage" => "https://static.politico.com/c3/fc/75793d08456698679761068cdf7d/u-s-congress-00120.jpg",
                    "publishedAt" => "2024-12-20T02:25:23Z",
                    "content" => "If somebody challenges Johnson, youre not going to get any pushback, said a Trump adviser, granted anonymity to speak frankly. Which means he wont save him if hes in trouble.\r\nJohnsons hold on power … [+5554 chars]"
                ],
                [
                    "source" => [
                        "id" => "cnn",
                        "name" => "CNN"
                    ],
                    "author" => "Kristen Rogers",
                    "title" => "Vagus nerve stimulation may relieve treatment-resistant depression, study finds - CNN",
                    "description" => "Vagus nerve stimulation therapy improved the symptoms of treatment-resistant depression for nearly 500 participants in a major clinical trial.",
                    "url" => "https://www.cnn.com/2024/12/19/health/vagus-nerve-stimulation-depression-treatment-wellness/index.html",
                    "urlToImage" => "https://media.cnn.com/api/v1/images/stellar/prod/gettyimages-1434944848-20241217185343925.jpg?c=16x9&q=w_800,c_fill",
                    "publishedAt" => "2024-12-20T02:23:00Z",
                    "content" => "Sign up for CNNs Stress, But Less newsletter. Our six-part mindfulness guide will inform and inspire you to reduce stress while learning how to harness it.\r\nNick Fournie was 24 years old when severe … [+12522 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "BBC News"
                    ],
                    "author" => null,
                    "title" => "Dominique Pelicot's double life => Who is the man who plotted his wife's mass rape? - BBC.com",
                    "description" => "The ex-husband - who is under investigation for other attacks - has a divided personality, a doctor finds.",
                    "url" => "https://www.bbc.com/news/articles/clynx2q93q1o",
                    "urlToImage" => "https://ichef.bbci.co.uk/news/1024/branded_news/7d21/live/9f387cd0-be5d-11ef-a0f2-fd81ae5962f4.jpg",
                    "publishedAt" => "2024-12-20T02:07:18Z",
                    "content" => "Dominique Pelicot - captured in photos and a court sketch - has been sentenced to 20 years in prison\r\nIt was something in Dominique Pelicot's swagger, his \"élan\" - as the French might put it - that i… [+11314 chars]"
                ],
                [
                    "source" => [
                        "id" => "associated-press",
                        "name" => "Associated Press"
                    ],
                    "author" => "TRAVIS LOLLER, LEAH WILLINGHAM, JENNIFER SINCO KELLEHER",
                    "title" => "Farmers, business owners, fire survivors face uncertainty after $100B in disaster relief flounders - The Associated Press",
                    "description" => "American farmers, small business owners and wildfire survivors are among those who will suffer if Congress cannot agree on a new spending bill after President-elect Donald Trump abruptly rejected a bipartisan plan that included more than $100 billion in disas…",
                    "url" => "https://apnews.com/article/congress-spending-trump-disaster-aid-hurricanes-a323f632b18df527283bcd34f235f4e7",
                    "urlToImage" => "https://dims.apnews.com/dims4/default/5786568/2147483647/strip/true/crop/8000x4500+0+417/resize/1440x810!/quality/90/?url=https%3A%2F%2Fassets.apnews.com%2F94%2F5a%2Fe563b332c7cbf7f7009872507f47%2Fbc031e1978054c6fbe81967f22b8552b",
                    "publishedAt" => "2024-12-20T01:38:00Z",
                    "content" => "NASHVILLE, Tenn. (AP) American farmers, small business owners and wildfire survivors are among those who will suffer if Congress cannot agree on a new spending bill after President-elect Donald Trump… [+6071 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "[Removed]"
                    ],
                    "author" => null,
                    "title" => "[Removed]",
                    "description" => "[Removed]",
                    "url" => "https://removed.com",
                    "urlToImage" => null,
                    "publishedAt" => "2024-12-20T01:09:00Z",
                    "content" => "[Removed]"
                ],
                [
                    "source" => [
                        "id" => "reuters",
                        "name" => "Reuters"
                    ],
                    "author" => "Lisa Baertlein, Abhinav Parmar",
                    "title" => "FedEx to spin off its freight trucking business - Reuters",
                    "description" => "FedEx announced the much-anticipated spinoff of its freight trucking division on Thursday, as it restructures operations to focus on its core delivery business.",
                    "url" => "https://www.reuters.com/business/fedex-spin-off-its-less-than-truckload-freight-business-2024-12-19/",
                    "urlToImage" => "https://www.reuters.com/resizer/v2/FYPTWZEHFJKINHIC6XXMEDPMNA.jpg?auth=419e68b6a15f485f2c9b78e29197dc4d5cede4ec77642225454ca7fd6e758aeb&height=1005&width=1920&quality=80&smart=true",
                    "publishedAt" => "2024-12-20T00:36:00Z",
                    "content" => null
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "SpaceNews"
                    ],
                    "author" => "",
                    "title" => "Next Crew Dragon mission delayed a month - SpaceNews",
                    "description" => "Delays in the completion of a new Crew Dragon spacecraft will extend the stay of astronauts on the International Space Station by a month.",
                    "url" => "https://spacenews.com/next-crew-dragon-mission-delayed-a-month/",
                    "urlToImage" => "https://i0.wp.com/spacenews.com/wp-content/uploads/2024/12/54119772885_85c9dc439f_k.jpg?resize=1200%2C1150&ssl=1",
                    "publishedAt" => "2024-12-20T00:33:40Z",
                    "content" => "WASHINGTON Delays in the completion of a new Crew Dragon spacecraft will extend the stay of astronauts on the International Space Station by a month, including two who have been there since June.\r\nNA… [+3667 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "Hindustan Times"
                    ],
                    "author" => "HT News Desk",
                    "title" => "Putin's big statement on ending Ukraine war => 'Russia ready to compromise with...' - Hindustan Times",
                    "description" => "Putin said that Russia was ready to negotiate with anyone, including Ukraine President Volodymyr Zelenskyy | World News",
                    "url" => "https://www.hindustantimes.com/world-news/putins-big-statement-on-ending-ukraine-war-russia-ready-to-compromise-with-101734652238366.html",
                    "urlToImage" => "https://www.hindustantimes.com/ht-img/img/2024/12/20/1600x900/putin_trump_1734653560290_1734653560578.JPG",
                    "publishedAt" => "2024-12-20T00:30:48Z",
                    "content" => "Russia President Vladimir Putin said on Thursday that he is open to compromising over the Ukraine war in talks with US President-elect Donald Trump, emphasising that there are no preconditions for di… [+2545 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "CNBC"
                    ],
                    "author" => "Sean Conlon",
                    "title" => "Stock futures tick lower as traders await the Fed’s preferred inflation reading => Live updates - CNBC",
                    "description" => "All three major averages are on track for sharp losses on the week.",
                    "url" => "https://www.cnbc.com/2024/12/19/stock-market-today-live-updates.html",
                    "urlToImage" => "https://image.cnbcfm.com/api/v1/image/108077013-1734452579389-NYSE_Traders-OB-Photo-20241217-CC-PRESS-3.jpg?v=1734452791&w=1920&h=1080",
                    "publishedAt" => "2024-12-20T00:25:00Z",
                    "content" => "U.S. stock futures fell slightly on Thursday evening as traders anticipate the latest reading of the Federal Reserve's favorite inflation gauge.\r\nFutures tied to the Dow Jones Industrial Average fell… [+2299 chars]"
                ],
                [
                    "source" => [
                        "id" => null,
                        "name" => "New York Post"
                    ],
                    "author" => "Reuters",
                    "title" => "Nike CEO says sneaker giant ‘lost its obsession with sport,’ vows to revive iconic brand - New York Post ",
                    "description" => "Analysts said CEO Elliott Hill faces tough critics and a long slog to claw back lost market.",
                    "url" => "https://nypost.com/2024/12/19/business/nike-ceo-says-sneaker-giant-lost-its-obsession-with-sport/",
                    "urlToImage" => "https://nypost.com/wp-content/uploads/sites/2/2024/12/nike-q2-earnings.jpg?quality=75&strip=all&1734633047&w=1024",
                    "publishedAt" => "2024-12-19T23:50:00Z",
                    "content" => "Nike’s results beat modest estimates on Thursday and its shares jumped briefly, but the company soon dashed investor hopes and sent shares lower when a top executive predicted revenues would fall by … [+3276 chars]"
                ]
            ]
        ];
    }
}