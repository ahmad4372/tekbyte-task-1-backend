
# Tekbyt Skill Accessment Task #1
Registers a custom post type "Case Studies" with a custom taxonomy "Industry" and exposes it via WPGraphQL. Includes ACF fields and API enhancements for use in a headless setup.


## Architecture
This plugin follows a modular architecture to ensure maintainability, ease of extension, and clarity.

Structure:
- Main Plugin File (`tekbyte-task-1.php`): Acts as an entry point. It defines constants, loads required files, and initializes the plugin.
- `classes/Support/Singleton.php`: Contains a reusable Singleton trait/class to ensure only one instance of certain classes exists.
- `classes/Autoloader.php`: Implements an autoloader for dynamically requiring class files as needed, based on their namespaces.
- `classes/Bootstrap.php`: Responsible for bootstrapping the plugin. It coordinates the registration of custom post types, taxonomies, ACF integration, and GraphQL exposure.


Main Flow:
 - On loading, the main file checks if it runs within WordPress (`ABSPATH` check), then defines useful constants for file/directory references.
 - It manually loads the essential bootstrap, singleton, and autoloader classes.
 - Bootstrap is instantiated as a singleton, and its `run()` method is called to set up the plugin. This likely covers:
 - - Registering the "Case Studies" post type.
 - - Registering the "Industry" taxonomy.
 - - Linking ACF fields/groups to the custom post type.
 - - Integrating with WPGraphQL so these types and fields are available in the API.

Benefits of This Architecture:
- Separation of concerns, with logic grouped into appropriately named classes.
- Autoloading minimizes manual includes and makes extending the plugin easier.
- Centralized bootstrap logic streamlines initialization and future refactoring.
- Reusability using well-known patterns like Singleton.

In summary, this architecture is designed for a modern, object-oriented, and scalable WordPress plugin, compatible with advanced workflows such as headless CMS applications.


## Key Decisions:
- **Modular Architecture**: Split into singleton-based main classes, an autoloader, and a dedicated bootstrapper for clarity and ease of extension.

- **Advanced Custom Fields (ACF)**: Utilizes ACF to add structured, extensible metadata to case studies.

- **Custom code for Post Type & Taxonomy**: Registers a CPT "Case Studies" and taxonomy "Industry" for flexible case study content management.

- **Headless/Preview Links**: Rewrites preview links & REST URLs to support a decoupled frontend ("headless" setup).

- **Strict Namespacing & Autoloading**: Uses namespacing and autoloading for maintainability and to avoid conflicts.

- **No Direct Access**: Protects plugin from direct access for security best practices.

- **Constants for Paths**: Uses constants for versioning and path resolution to improve portability and reliability.

## How to run the project locally

Clone or download the plugin: `git clone https://github.com/ahmad4372/tekbyte-task-1-backend.git`

Copy or move the `tekbyte-task-1` folder into your WordPress installation's plugins directory (`wp-content/plugins/`).

Ensure you have the following plugin dependencies:
- WPGraphQL
- Advanced Custom Fields (ACF)
- WPGraphQL for ACF
- WPGraphQL JWT Authentication (Clone or download the plugin: `https://github.com/wp-graphql/wp-graphql-jwt-authentication`)
- Yoast SEO
- WPGraphQL Yoast SEO Addon

In your WordPress admin dashboard, go to Plugins and activate "Tekbyte Task 1".

Configure any necessary environment variables (e.g., for headless setup):
- Set `HEADLESS_URL` & `WP_HOME` (Frontend Installation URL) and `HEADLESS_SECRET` (Random App Token) in wp-config.php