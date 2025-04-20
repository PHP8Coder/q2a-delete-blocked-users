<?php

require_once QA_INCLUDE_DIR . 'db/users.php';
require_once QA_INCLUDE_DIR . 'app/users.php';
require_once QA_INCLUDE_DIR . 'app/posts.php';

class delete_blocked_users_admin
{
    public function admin_form(&$qa_content)
    {
        $ok = null;
        $deleted = 0;

        if (qa_clicked('delete_blocked_users_submit')) {
            $users = qa_db_read_all_assoc(
                qa_db_query_sub(
                    "SELECT userid FROM ^users WHERE (flags & #) != 0",
                    QA_USER_FLAGS_USER_BLOCKED
                )
            );

            foreach ($users as $user) {
                $userid = $user['userid'];

                 $posts = qa_db_read_all_assoc(
                    qa_db_query_sub(
                        "SELECT postid FROM ^posts WHERE userid = #",
                        $userid
                    )
                );

                foreach ($posts as $post) {
                    qa_post_delete($post['postid']);
                }

                 qa_db_user_delete($userid);
                $deleted++;
            }

            $ok = "$deleted blocked users have been deleted.";
        }

      return array(
            'ok' => $ok,
            'fields' => array(
                array(
                    'label' => 'Delete all blocked users',
                    'type'  => 'static',
                    'value' => 'This removes ALL users who are currently marked as blocked, including their posts.',
                )
            ),
            'buttons' => array(
                array(
                    'label' => 'Delete blocked users now',
                    'tags'  => 'name="delete_blocked_users_submit" onclick="return confirm(\'Really delete all blocked users?\')"',
                ),
            ),
        );
    }
}
