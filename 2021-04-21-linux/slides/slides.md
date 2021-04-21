## Blumilk Internal Meetup #5


\
\
<img width="400" data-src="presentations/2021-04-21-linux/images/logobig.jpg">

\
\
\
Jacek Sawoszczuk 21.04.2021

---

<div style='position:relative; padding-bottom:calc(75.00% + 44px)'><iframe src='https://gfycat.com/ifr/WelldocumentedFavoriteHydra' frameborder='0' scrolling='no' width='100%' height='100%' style='position:absolute;top:0;left:0;' allowfullscreen></iframe></div>

---

### UNIX?

### GNU?

### Linux?

---

<img width="400" data-src="presentations/2021-04-21-linux/images/free_software.png">

---

<img width="700" data-src="presentations/2021-04-21-linux/images/os_history.png">

---

<img data-src="presentations/2021-04-21-linux/images/OS-Crude-Timeline-distros2.png">

---

<img width="150" data-src="presentations/2021-04-21-linux/images/distros/linux_distros.png">

---

## What makes a linux distro?

- kernel
- GNU shell core utilities
- X server
- desktop environment
- folder structure
- preinstalled software
- software distribution channels
- general organization
- community

---

<h2 style="text-align: left;">/</h2>

<div style="width: 40%; float: left;">
<ul>
  <li>/bin</li>
  <li>/boot</li>
  <li>/dev</li>
  <li>/etc</li>
  <li>/home</li>
  <li>/lib</li>
  <li>/media</li>
  <li>/mnt</li>
</ul>
</div>
<div style="width: 40%; float: left;">
<ul>
  <li>/opt</li>
  <li>/proc</li>
  <li>/root</li>
  <li>/sbin</li>
  <li>/tmp</li>
  <li>/usr</li>
  <li>/var</li>
</ul>
</div>

---

<h2 style="text-align: left;">/home</h2>

<div style="width: 40%; float: left;">
<ul>
  <li>/bin</li>
  <li>/boot</li>
  <li>/dev</li>
  <li>/etc</li>
  <li style="background: black; color: white; padding: 5px 15px; border-radius: 15px;">/home</li>
  <li>/lib</li>
  <li>/media</li>
  <li>/mnt</li>
</ul>
</div>
<div style="width: 40%; float: left;">
<ul>
  <li>/opt</li>
  <li>/proc</li>
  <li>/root</li>
  <li>/sbin</li>
  <li>/tmp</li>
  <li>/usr</li>
  <li>/var</li>
</ul>
</div>

---

## Installing Software

- apt (+ppa/external repos)
- deb
- snap
- flatpak
- appimage

---

## chmod 777
### -rwxrwxrwx

---

## Advanced permissions

SUID / GUID / Sticky Bit / UMASK

<section>
  <pre><code data-trim>
  4       1
SUID   Sticky Bit
  ↓     ↓
rwsrwsrwt
     ↑
   GUID
     2
  </pre></code data-trim>
</section>

---

<img data-src="presentations/2021-04-21-linux/images/vi-kings.jpg">

---

<img data-src="presentations/2021-04-21-linux/images/nano-is-better.png">

---

<kbd style="display: inline-block; border: 1px solid black; width: 2.5ex; height: 2.5ex; ">H</kbd>
<kbd style="display: inline-block; border: 1px solid black; width: 2.5ex; height: 2.5ex; ">J</kbd>
<kbd style="display: inline-block; border: 1px solid black; width: 2.5ex; height: 2.5ex; ">K</kbd>
<kbd style="display: inline-block; border: 1px solid black; width: 2.5ex; height: 2.5ex; ">L</kbd>

(esc i : /)

---

### Vi keybindings

fzf | bat | ranger <br />
tmux | code | browser | desktop | documents

---

<h3>how to not <br /><span style="font-size: 70%">(be afraid to)</span> <br />break stuff</h3>

- strategy 1: git gud
- strategy 2: don't change anything (nothing to lose on reinstall)
- strategy 3: version dotfiles ([examples](https://github.com/search?q=dotfiles))
- strategy 4: separate `/home` partition (quick reinstall)

---

### how to remember commands / arguments

- git gud (muscle memory)
- man / info / apropos
- [tldr](https://tldr.sh) / [cheat](https://github.com/cheat/cheat)
- own notes
- fish
- [explainshell](https://explainshell.com)

---

## alternatives to bash

- ash
- zsh
- fish

---

(return codes)

0 / 1 / …

---

(data streams)

- 0: stdin
- 1: stdout
- 2: stderr

	find / -iname docker
	find / -iname docker > result 2> errors
	find / -iname docker 2> /dev/null
	find / -iname docker > /dev/null 2>&1

---

(aliases)

---

(expansions)

- sudo !!
- cd
- cd ~
- cd -
- echo file_{one,two}
- echo echo file_{1..3}

---

(killing)

- `kill <pid>`
- `killall <name>`
- `xkill`

-15 vs -9

---

(toolbox)

- tmux
- tmuxinator
- gh
- fzf
- vidir (moreutils)
- bat
- rg
- ranger

---

(other)

- git status on cli ([git-bash-prompt](https://github.com/magicmonty/bash-git-prompt))
- [$PS1](http://bashrcgenerator.com)
- $PATH …
- #!

---

# The End
