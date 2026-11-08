// Lance PHPCS avec les standards installés par bin/setup-phpcs.mjs.
// Usage : node bin/phpcs.mjs [options phpcs…]      (par défaut : la configuration de phpcs.xml.dist)
import { existsSync, mkdirSync } from 'node:fs';
import { spawnSync } from 'node:child_process';
import { dirname, join, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const phar = join(root, '.phpcs', 'phpcs.phar');

const php = spawnSync('php', ['-v'], { stdio: 'ignore' });
if (php.error || php.status !== 0) {
  console.error('PHP est introuvable dans le PATH : il est nécessaire pour lancer PHPCS.');
  process.exit(1);
}

// phpcs.xml.dist écrit son cache dans .cache/ : PHPCS refuse de démarrer si le dossier n'existe pas.
mkdirSync(join(root, '.cache'), { recursive: true });

if (!existsSync(phar)) {
  const setup = spawnSync(process.execPath, [join(root, 'bin', 'setup-phpcs.mjs')], { stdio: 'inherit' });
  if (setup.status !== 0) process.exit(setup.status ?? 1);
}

const retraceurCS = process.env.RETRACEUR_CS_PATH
  ? resolve(process.env.RETRACEUR_CS_PATH)
  : join(root, '.phpcs', 'RetraceurCS');

const installedPaths = [
  join(root, '.phpcs', 'PHPCSUtils'),
  join(root, '.phpcs', 'PHPCSExtra'),
  join(root, '.phpcs', 'WordPressCS'),
  retraceurCS,
].join(',');

const result = spawnSync(
  'php',
  [phar, '--runtime-set', 'installed_paths', installedPaths, ...process.argv.slice(2)],
  { stdio: 'inherit', cwd: root }
);
process.exit(result.status ?? 1);
