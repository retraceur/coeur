// Downloads PHPCS & code standards in `.phpcs/`.
// Fires on `npm install` command as a postinstall script.
//
// If you need to use a local clone of Retraceur php-coding-standards:
// => use the `RETRACEUR_CS_PATH` environment variable to set the path
// to your local clone.
// In this case, RetraceurCS is not downloaded.
import { mkdirSync, existsSync, writeFileSync, readFileSync, rmSync } from 'node:fs';
import { createHash } from 'node:crypto';
import { execFileSync } from 'node:child_process';
import { dirname, join, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const dir = join(root, '.phpcs');
const deps = JSON.parse(readFileSync(join(root, 'phpcs-deps.json'), 'utf8'));
const stampFile = join(dir, '.installed.json');
const stamp = existsSync(stampFile) ? JSON.parse(readFileSync(stampFile, 'utf8')) : {};

mkdirSync(dir, { recursive: true });

for (const [name, dep] of Object.entries(deps)) {
  if (name === 'RetraceurCS' && process.env.RETRACEUR_CS_PATH) {
    console.log(`[phpcs] RetraceurCS: using ${process.env.RETRACEUR_CS_PATH}`);
    continue;
  }

  const target = join(dir, name === 'phpcs' ? 'phpcs.phar' : name);
  if (stamp[name] === dep.version && existsSync(target)) continue;

  console.log(`[phpcs] ${name} ${dep.version}…`);
  const res = await fetch(dep.url);
  if (!res.ok) {
    const hint =
      name === 'RetraceurCS'
        ? '\n  The repository or tag does not seem to be published: define the path to your php-coding-standards local clone in RETRACEUR_CS_PATH.'
        : '';
    throw new Error(`${name}: HTTP ${res.status} on ${dep.url}${hint}`);
  }
  const buf = Buffer.from(await res.arrayBuffer());
  const actual = createHash('sha256').update(buf).digest('hex');

  if (!dep.sha256) {
    throw new Error(
      `${name}: no checksum specified in phpcs-deps.json.\n` +
        `  Check the archive, than add : "sha256": "${actual}"`
    );
  }
  if (actual !== dep.sha256) {
    throw new Error(`${name}: invalid checksum\n  expected: ${dep.sha256}\n  current: ${actual}`);
  }

  if (name === 'phpcs') {
    writeFileSync(target, buf);
  } else {
    const archive = join(dir, `${name}.tar.gz`);
    rmSync(target, { recursive: true, force: true });
    mkdirSync(target, { recursive: true });
    writeFileSync(archive, buf);
    execFileSync('tar', ['-xzf', archive, '-C', target, '--strip-components=1']);
    rmSync(archive);
  }
  stamp[name] = dep.version;
}

writeFileSync(stampFile, JSON.stringify(stamp, null, 2));
console.log('[phpcs] ready.');
