<?php
/**
 * Template part for displaying the Typography Test page template content.
 *
 * @package    Vagabond
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<article class="entry">
	<div class="entry-content">
		<section id="typography">
			<p class="lead-text">
				At sight of these strange, swift, and terrible creatures the crowd near the water's edge seemed to me to be for
				a moment horror-struck. There was no screaming or shouting, but a silence.
			</p>

			<p>
				Then a hoarse murmur and a movement of feet - a splashing from the water. A man, too frightened to drop the
				portmanteau he carried on his shoulder, swung round and sent me staggering with a blow from the corner of his
				burden. A woman thrust at me with her hand and rushed past me. I turned with the rush of the people, but I was
				not too terrified for thought. The terrible Heat-Ray was in my mind. To get under water! That was it!
			</p>

			<p>"Get under water!" I shouted, unheeded.</p>

			<p>
				I faced about again, and rushed towards the approaching Martian, rushed right down the gravelly beach and
				headlong into the water. Others did the same. A boatload of people putting back came leaping out as I rushed
				past. The stones under my feet were muddy and slippery, and the river was so low that I ran perhaps twenty feet
				scarcely waist-deep.
			</p>

			<h3>Text Styles</h3>

			<p>
				Then, as <em>the Martian towered overhead</em> scarcely a couple of hundred yards away,
				<strong>I flung myself forward under the surface</strong>. The splashes of the people in the boats leaping into
				the river sounded like <a href="#">thunderclaps in my ears</a>. People were landing hastily on both sides of the
				river. But <a class="label-link" href="#">the Martian machine</a> took no more notice for the moment of the
				people running this way and that than a man would of the confusion of ants in a nest against which his foot has
				kicked. When, half suffocated, I raised my head above water,
				<mark>the Martian's hood pointed at the batteries</mark> that were still firing across the river, and as it
				advanced it swung loose what must have been the generator of the <del>Death-Ray</del> Heat-Ray.
			</p>

			<hr />

			<h3>Headings</h3>

			<p>Heading styles for h1, h2, h3, h4, h5, and h6.</p>

			<h1>h1.Heading</h1>
			<h2>h2.Heading</h2>
			<h3>h3.Heading</h3>
			<h4>h4.Heading</h4>
			<h5>h5.Heading</h5>
			<h6>h6.Heading</h6>

			<hr />

			<h3>Preformatted</h3>

			<p>The following <code>&lt;code&gt;</code> snippet can be used to get tomorrow's date in JavaScript.</p>

			<pre>
// Get tomorrow's date.
var tomorrow = function tomorrow() {
var t = new Date();

t.setDate(t.getDate() + 1);
return t.toISOString().split('T')[0];
};</pre>

			<hr />

			<h3>List Styles</h3>

			<div class="row">
				<div class="col-sm-12 col-md-6">
					<h4>Ordered List</h4>
					<ol>
						<li>One</li>
						<li>
							Two
							<ol>
								<li>Two.One</li>
								<li>Two.Three</li>
							</ol>
						</li>
						<li>Three</li>
						<li>Four</li>
					</ol>
				</div>

				<div class="col-sm-12 col-md-6">
					<h4>Unordered List</h4>
					<ul>
						<li>One</li>
						<li>
							Two
							<ul>
								<li>Two.One</li>
								<li>Two.Three</li>
							</ul>
						</li>
						<li>Three</li>
						<li>Four</li>
					</ul>
				</div>
			</div>

			<h4>Definition List</h4>

			<dl>
				<dt>Definition List Title</dt>
				<dd>This is a definition list division.</dd>
			</dl>

			<dl>
				<dt>Definition List Title</dt>
				<dd>This is a definition list division.</dd>
				<dd>This is a definition list division.</dd>
				<dd>This is a definition list division.</dd>
			</dl>

			<p>
				Learn more about
				<a href="https://css-tricks.com/utilizing-the-underused-but-semantically-awesome-definition-list/" target="_blank">utilizing definition lists</a>.
			</p>

			<hr />

			<h3>Blockquote</h3>

			<p>
				In another moment it was on the bank, and in a stride wading halfway across. The knees of its foremost legs bent
				at the farther bank, and in another moment it had raised itself to its full height again, close to the village
				of Shepperton.
			</p>

			<blockquote>
				<p>
					Forthwith the six guns which, unknown to anyone on the right bank, had been hidden behind the outskirts of
					that village, fired simultaneously. The sudden near concussion, the last close upon the first, made my heart
					jump.
				</p>
				<cite>
					<span class="author">The Martian, </span>
					<span class="position">Earth Invader - </span>
					<span class="company">Planet Mars</span>
				</cite>
			</blockquote>

			<p>
				The monster was already raising the case generating the Heat-Ray as the first shell burst six yards above the
				hood.
			</p>

			<hr />

			<h3>Content Boxes</h3>

			<div class="content-box-blue">
				I gave a cry of astonishment. I saw and thought nothing of the other four Martian monsters; my attention was
				riveted upon the nearer incident.
			</div>

			<div class="content-box-gray">
				Simultaneously two other shells burst in the air near the body as the hood twisted round in time to receive, but
				not in time to dodge, the fourth shell.
			</div>

			<div class="content-box-green">
				The shell burst clean in the face of the Thing. The hood bulged, flashed, was whirled off in a dozen tattered
				fragments of red flesh and glittering metal.
			</div>

			<div class="content-box-purple">
				"Hit!" shouted I, with something between a scream and a cheer. I heard answering shouts from the people in the
				water about me.
			</div>

			<div class="content-box-red">
				I could have leaped out of the water with that momentary exultation. The decapitated colossus reeled like a
				drunken giant; but it did not fall over.
			</div>

			<div class="content-box-yellow">
				It recovered its balance by a miracle, and, no longer heeding its steps and with the camera that fired the
				Heat-Ray now rigidly upheld, it reeled swiftly upon Shepperton.
			</div>

			<hr />
		</section>

		<section id="buttons">
			<h2>Buttons</h2>

			<div class="button-group">
				<h4>Sizes and Styles</h4>
				<p><a class="button button-small button-square" href="#" target="_self">Small</a></p>
				<p><a class="button button-square" href="#" target="_self">Default</a></p>
				<p><a class="button button-large button-square" href="#" target="_self">Large</a></p>
				<p><a class="button button-round" href="#" target="_self">Rounded</a></p>
				<p style="text-align: left;"><a class="button button-square" href="#" target="_self">Left</a></p>
				<p style="text-align: center;">
					<a class="button button-square" href="#" target="_self">Center</a>
				</p>
				<p style="text-align: right;"><a class="button button-square" href="#" target="_self">Right</a></p>

				<h4>Extra Colors</h4>
				<p><a class="button button-secondary button-square" href="#" target="_self">Secondary</a></p>
				<p><a class="button button-tertiary button-square" href="#" target="_self">Tertiary</a></p>
				<p><a class="button button-ghost button-square" href="#" target="_self">Ghost</a></p>
			</div>

			<hr />
		</section>

		<section id="forms">
			<h2>Fieldsets and Form Elements</h2>

			<fieldset>
				<p>
					The living intelligence, the Martian within the hood, was slain and splashed to the four winds of heaven,
					and the Thing was now but a mere intricate device of metal whirling to destruction. It drove along in a
					straight line, incapable of guidance. It struck the tower of Shepperton Church, smashing it down as the
					impact of a battering ram might have done, swerved aside, blundered on and collapsed with tremendous force
					into the river out of my sight.
				</p>

				<form>
					<h3>Form Element</h3>

					<p>
						A violent explosion shook the air, and a spout of water, steam, mud, and shattered metal shot far up
						into the sky.
					</p>

					<p>
						<label for="text_field">Text Field:</label>
						<input type="text" id="text_field" placeholder="This is a placeholder" />
					</p>

					<p>
						<label for="text_area">Text Area:</label>
						<textarea id="text_area" rows="8"></textarea>
					</p>

					<p>
						<label for="select_element">Select Element:</label>
						<select name="select_element">
							<optgroup label="Option Group 1">
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</optgroup>
							<optgroup label="Option Group 2">
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</optgroup>
						</select>
					</p>

					<p>
						<label for="radio_buttons">Radio Buttons:</label>
						<label> <input type="radio" class="radio" name="radio_button" value="radio_1" /> Radio 1 </label>
						<label> <input type="radio" class="radio" name="radio_button" value="radio_2" /> Radio 2 </label>
						<label> <input type="radio" class="radio" name="radio_button" value="radio_3" /> Radio 3 </label>
					</p>

					<p>
						<label for="checkboxes">Checkboxes:</label>
						<label> <input type="checkbox" class="checkbox" name="checkboxes" value="check_1" /> Checkbox 1 </label>
						<label> <input type="checkbox" class="checkbox" name="checkboxes" value="check_2" /> Checkbox 2 </label>
						<label> <input type="checkbox" class="checkbox" name="checkboxes" value="check_3" /> Checkbox 3 </label>
					</p>

					<p>
						<label for="password">Password:</label>
						<input type="password" class="password" name="password" />
					</p>

					<p>
						<label for="file">File Input:</label>
						<input type="file" class="file" name="file" />
					</p>

					<p>
						<input type="submit" value="Submit" />
					</p>
				</form>
			</fieldset>

			<hr />
		</section>

		<section id="tables">
			<h2>Tables</h2>

			<table cellspacing="0" cellpadding="0">
				<tr>
					<th>Table Header 1</th>
					<th>Table Header 2</th>
					<th>Table Header 3</th>
				</tr>
				<tr>
					<td>Division 1</td>
					<td>Division 2</td>
					<td>Division 3</td>
				</tr>
				<tr class="even">
					<td>Division 1</td>
					<td>Division 2</td>
					<td>Division 3</td>
				</tr>
				<tr>
					<td>Division 1</td>
					<td>Division 2</td>
					<td>Division 3</td>
				</tr>
			</table>
		</section>
	</div>
</article>
<?php
