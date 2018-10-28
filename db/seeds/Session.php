<?php

use Phinx\Seed\AbstractSeed;

class Session extends AbstractSeed
{
    const ID_SESSIONS = [
        1,
        2
    ];

    public function run()
    {
        $date = DateTimeImmutable::createFromFormat('U', strtotime('-' .rand(1, 5). ' days'));

        $sessions = [
            [
                'session_id' => self::ID_SESSIONS[0],
                'id_forum' => Event::ID_FORUM,
                'date_soumission' => $date->format('Y-m-d'),
                'titre' => 'Jouons tous ensemble à un petit jeu',
                'abstract' => 'Hey ! Tu as participé au quiz du #SuperApéroPHP ? Tu te demandes : mais comment ont-ils fait ? Ne cherche pas plus loin, je te propose de nous retrouver pour un petit jeu et de découvrir ensemble l\'envers du décor ! Au programme : une session interactive avec Laravel / Laravel Echo / Redis et Socket.IO.',
                'staff_notes' => null,
                'journee' => 0,
                'genre' => 1,
                'skill' => 0,
                'plannifie' => 1,
                'needs_mentoring' => 0,
                'youtube_id' => 'MseSkWbhxV8',
                'video_has_fr_subtitles' => 0,
                'video_has_en_subtitles' => 0,
                'slides_url' => 'https://speakerdeck.com/caporaldead/jouons-tous-ensemble-a-un-petit-jeu',
                'blog_post_url' => '',
                'language_code' => 'fr',
                'markdown' => 1,
                'joindin' => 24041,
                'date_publication' => $date->format('Y-m-d H:i:s')
            ],
            [
                'session_id' => self::ID_SESSIONS[1],
                'id_forum' => Event::ID_FORUM,
                'date_soumission' => $date->format('Y-m-d'),
                'titre' => 'REST ou GraphQL ? Exemples illustrés avec Symfony et API Platform',
                'abstract' => '<p>GraphQL est une alternative aux architectures REST pour la r&eacute;alisation d&rsquo;API web. Le langage promu par Facebook a des avantages ind&eacute;niab
les : r&eacute;cup&eacute;ration des donn&eacute;es utiles uniquement, limitation du nombre de requ&ecirc;tes, typage fort, syntaxe puissante et bien pens&eacute;e&hellip; Cependant, 
il souffre aussi de d&eacute;fauts souvent sous-estim&eacute;s parmi lesquels l&rsquo;incompatibilit&eacute; avec les m&eacute;canismes de cache, de log, de s&eacute;curit&eacute; ou d&rsquo;auth qui forment la base du stack web d&rsquo;aujourd&rsquo;hui, ou la n&eacute;cessit&eacute; d\'un parser sp&eacute;cifique. De plus, les formats hypermedias modernes s&rsquo;appuyant sur REST disposent de fonctionnalit&eacute;s tr&egrave;s similaires tout en restant compatibles avec les fondements du web. Le framework API Platform, bas&eacute; sur Symfony, permet de cr&eacute;er tr&egrave;s facilement des API REST (JSON-LD, JSON API&hellip;) et GraphQL. Apr&egrave;s avoir &eacute;num&eacute;r&eacute; les avantages et inconv&eacute;nients des diff&eacute;rents formats, nous &eacute;tudierons au travers de diff&eacute;rents cas d&rsquo;usages quand il est pr&eacute;f&eacute;rable d&rsquo;utiliser GraphQL, REST ou les 2 en compl&eacute;ment.</p>',
                'staff_notes' => null,
                'journee' => 0,
                'genre' => 1,
                'skill' => 2,
                'plannifie' => 1,
                'needs_mentoring' => 0,
                'youtube_id' => 'QhAToFl_Omo',
                'video_has_fr_subtitles' => 0,
                'video_has_en_subtitles' => 0,
                'slides_url' => 'https://dunglas.fr/2018/03/symfonylive-paris-slides-rest-vs-graphql-illustrated-examples-with-the-api-platform-framework/',
                'blog_post_url' => '',
                'language_code' => 'fr',
                'markdown' => 0,
                'joindin' => 24138,
                'date_publication' => $date->format('Y-m-d H:i:s')
            ],
        ];

        $table = $this->table('afup_sessions');
        $table->truncate();

        $table
            ->insert($sessions)
            ->save()
        ;

        $i = 1;
        $plannings = [];
        foreach ($sessions as $session) {
            $plannings[] = [
                'id' => $i,
                'id_session' => $session['session_id'],
                'debut' => $date->format('Y-m-d H:i:s'),
                'fin' => $date->format('Y-m-d H:i:s'),
                'id_salle' => 0,
                'id_forum' => Event::ID_FORUM,
                'keynote' => ''
            ];
            ++$i;
        }

        $table = $this->table('afup_forum_planning');
        $table->truncate();

        $table
            ->insert($plannings)
            ->save()
        ;
    }
}
