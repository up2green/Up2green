set :application, "www.up2green"
set :domain,      "#{application}.com"
set :deploy_to,   "/srv/www/#{domain}"
set :app_path,    "app"

set :user, "clement"
set :repository,    "https://github.com/SmartIT-Fr/Up2green.git"
set :scm,           :git
set :model_manager, "propel"
set :deploy_via, :rsync_with_remote_cache
default_run_options[:pty] = true
set :dump_assetic_assets, true

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", web_path + "/uploads", "vendor"]
set :use_composer, true

set :writable_dirs,       ["app/cache", "app/logs", "web/uploads"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

set  :keep_releases,  3
set  :use_sudo,  false

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL