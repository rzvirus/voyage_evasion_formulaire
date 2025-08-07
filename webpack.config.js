const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('app', './assets/app.js')
    
    // ✅ Ajout de l'entrée CSS pour les pages d'authentification
    .addStyleEntry('auth-pages', './assets/css/auth-pages.css')

    .addEntry('pays/afrique', './assets/pages/afrique.js')
    .addEntry('pays/afriquedusud', './assets/pays/afriquedusud.js')
    .addEntry('pays/alaune', './assets/pages/alaune.js')
    .addEntry('pays/amerique', './assets/pages/amerique.js')
    .addEntry('pays/argentine', './assets/pays/argentine.js')
    .addEntry('pays/asie', './assets/pages/asie.js')
    .addEntry('pays/bresil', './assets/pays/bresil.js')
    .addEntry('pays/contact', './assets/pages/contact.js')
    .addEntry('pays/destination', './assets/pages/destination.js')
    .addEntry('pays/egypte', './assets/pays/egypte.js')
    .addEntry('pays/espagne', './assets/pays/espagne.js')
    .addEntry('pays/europe', './assets/pages/europe.js')
    .addEntry('pays/france', './assets/pays/france.js')
    .addEntry('pays/iles', './assets/pages/iles.js')
    .addEntry('pays/italie', './assets/pays/italie.js')
    .addEntry('pays/japon', './assets/pays/japon.js')
    .addEntry('pays/connexion', './assets/pages/connexion.js')
    .addEntry('pays/maldives', './assets/pays/maldives.js')
    .addEntry('pays/maroc', './assets/pays/maroc.js')
    .addEntry('pays/qsn', './assets/pages/qsn.js')
    .addEntry('pays/reunion', './assets/pays/reunion.js')
    .addEntry('pays/inscription', './assets/pages/inscription.js')
    .addEntry('pays/tahiti', './assets/pays/tahiti.js')
    .addEntry('pays/thailande', './assets/pays/thailande.js')
    .addEntry('pays/usa', './assets/pays/usa.js')
    .addEntry('pays/vietnam', './assets/pays/vietnam.js')
    .addEntry('accueil', './assets/pages/accueil.js')

    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = '3.38';
    })

    // ✅ Copie les images dans public/build/images
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]',
    });

module.exports = Encore.getWebpackConfig();