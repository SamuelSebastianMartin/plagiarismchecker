Plagiarism Checker
==================

This is a project to create a plagiarism checking *Moodle block*,
that will take a text, and check it against an original.

**Note:** It does not check against internet sources, databases etc.

Use
---

As this is intended for a *Moodle block*, the use will be
defined by the Moodle interface. Until that time, use

      php plagcheck.php

Overview
--------

An essay or summary `text` is compared with an original text or reading: `orig`. The `text` is output as submitted, but
with plagiarised text highlighted in the new document.

These are the steps:

* The text (written by a student) is broken into un-punctuated,
  lowercase words, and stored in the array `$words`. These
  words are then worked through systematically to check if they
  are used in the same order in the original: this would be
  plagiarism.

* Each word (or rather it's *index*) is used to create a `Match` object. This object:

    - incrementally adds words to a *regular expression* and
      checks for *regex*  matches in the original, returning
      `NULL` if there is no match, or adding another word
      to the *regex* and checking again.

    - stores the span (start and end index) of the `words` array
      which corresponds to the duplicate/plagiarised section.
      Stores the span, also, in the `text` as well as the actual
      text itself.

    - updates the *index* from the `words` array.

    - updates the index from the `text`, so that (should a
      plagiarised section be repeated in the essay text) the
      same section is not identified twice.

    - Checks for overlaps between 2 plagiarised sections, and
      resolves the conflicts.

    - returns `None`, `plag` or `overlap`, so that the section of
      `text` can be formatted accordingly in the output document.

* If there is plagiarism, the `Match` object is stored in an
  output array: `$matches`.

* When each `Match` object is completed with a `plag` tag, the
  gap between it and the last `Match` is filled with another
  `Match` tagged with `NULL`. This represents the text which is
  **not** plagiarised, and so is printed without highlighting
  in the output. (Obviously, spaces between words are handled
  here.)

The steps above proceed paragraphwise, and are only sent to
output when all paragraphs have been exhausted.
