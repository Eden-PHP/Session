![logo](http://eden.openovate.com/assets/images/cloud-social.png) Eden Session
====
[![Build Status](https://api.travis-ci.org/Eden-PHP/Session.png)](https://travis-ci.org/Eden-PHP/Session)
====

- [Install](#install)
- [Introduction](#intro)
- [API](#api)
    - [clear](#clear)
    - [get](#get)
    - [getId](#getId)
    - [remove](#remove)
    - [set](#set)
    - [setId](#setId)
    - [start](#start)
    - [stop](#stop)
- [Contributing](#contributing)

====

<a name="install"></a>
## Install

`composer install eden/session`

====

<a name="intro"></a>
## Introduction

Before using sessions, it's probably a good idea to start the session.

```
$session = eden('session')->start();
```

The session returned is an array object and can be used like a normal array.

```
$session['me']    = array('name' => 'John', 'age' => 31);
$session['you']    = array('name' => 'Jane', 'age' => 28);
$session['him']    = array('name' => 'Jack', 'age' => 35);

foreach($session as $key => $value) {
	echo $value['name'];
}
```
==== 



<a name="clear"></a>

### clear

Removes all session data 

#### Usage

```
eden('session')->clear();
```

#### Parameters

Returns `Eden\Session\Index`

==== 

<a name="get"></a>

### get

Returns data 

#### Usage

```
eden('session')->get(string|null $key);
```

#### Parameters

 - `string|null $key` - The key from the session

Returns `scalar|null|array`

#### Example

```
eden('session')->get();
```

==== 

<a name="getId"></a>

### getId

Returns session id 

#### Usage

```
eden('session')->getId();
```

#### Parameters

Returns `int`

==== 

<a name="remove"></a>

### remove

Removes a session. 

#### Usage

```
eden('session')->remove(*string $name);
```

#### Parameters

 - `*string $name` - session name

Returns `Eden\Session\Index`

#### Example

```
eden('session')->remove('foo');
```

==== 

<a name="set"></a>

### set

Sets data 

#### Usage

```
eden('session')->set(*array|string $data, mixed $value);
```

#### Parameters

 - `*array|string $data` - The array data to set
 - `mixed $value` - If data is a key then this is the value

Returns `Eden\Session\Index`

#### Example

```
eden('session')->set(array('foo' => 'bar'));
```

==== 

<a name="setId"></a>

### setId

Sets the session ID 

#### Usage

```
eden('session')->setId(*int $id);
```

#### Parameters

 - `*int $id` - The prescribed session ID to use

Returns `int`

#### Example

```
eden('session')->setId(123);
```

==== 

<a name="start"></a>

### start

Starts a session 

#### Usage

```
eden('session')->start();
```

#### Parameters

Returns `Eden\Session\Index`

==== 

<a name="stop"></a>

### stop

Starts a session 

#### Usage

```
eden('session')->stop();
```

#### Parameters

Returns `Eden\Session\Index`

==== 

<a name="contributing"></a>
#Contributing to Eden

Contributions to *Eden* are following the Github work flow. Please read up before contributing.

##Setting up your machine with the Eden repository and your fork

1. Fork the repository
2. Fire up your local terminal create a new branch from the `v4` branch of your 
fork with a branch name describing what your changes are. 
 Possible branch name types:
    - bugfix
    - feature
    - improvement
3. Make your changes. Always make sure to sign-off (-s) on all commits made (git commit -s -m "Commit message")

##Making pull requests

1. Please ensure to run `phpunit` before making a pull request.
2. Push your code to your remote forked version.
3. Go back to your forked version on GitHub and submit a pull request.
4. An Eden developer will review your code and merge it in when it has been classified as suitable.