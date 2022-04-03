USE db_alinea;


-- insertion de l'album MADISON et ses liens dans la table `album`
INSERT INTO music_album
    (
        name
        , link_spotify
        , link_applemusic
        , link_itunes
        , link_deezer
        , link_amazonmusic
        , link_googleplay
        , link_tidal
    )
VALUES
    (
        'Madison'
        , 'https://open.spotify.com/album/5tUsiwIBO4IZFMte8EkkcO?si=28KYkyTjSXebE2GWhxlysQ'
        , 'https://music.apple.com/fr/album/1531322642?uo=4&app=music&at=1001l34Ux&lId=22318004&cId=none&sr=1&src=Linkfire&itscg=30440&itsct=catchall_p1&ct=LFV_2805aead92b6e14097073b3071c592dd&ls=1'
        , 'https://itunes.apple.com/fr/album/1531322642?uo=4&app=itunes&at=1001l34Ux&lId=22318004&cId=none&sr=3&src=Linkfire&itscg=30440&itsct=catchall_p3&ct=LFV_2805aead92b6e14097073b3071c592dd&ls=1'
        , 'https://www.deezer.com/album/172483402?app_id=140685&utm_source=partner_linkfire&utm_campaign=2805aead92b6e14097073b3071c592dd&utm_medium=Original&utm_term=objective-stream&utm_content=album-172483402'
        , 'https://amazon.fr/dp/B08HSDWK6X?tag=imusician05-21&ie=UTF8&linkCode=as2&ascsubtag=2805aead92b6e14097073b3071c592dd'
        , 'https://play.google.com/store/music/album/Alin%C3%A9a_Madison?id=Ba4yvl3rhoeyh4o6kjnsc2pwh3y&PCamRefID=LFV_1c459a9ca8eb5ef05589b2ae73a5fece&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'
        , 'http://listen.tidalhifi.com/album/154990559'
    )
;


-- insertion de l'album 'Nouveaux Morceaux' table `album`
INSERT INTO music_album
    (
        name
    )
VALUES
    (
        'Nouveaux Morceaux'
    )
;