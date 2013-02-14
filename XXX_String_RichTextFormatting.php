<?php

abstract class XXX_String_RichTextFormatting
{
	public static function getTags ($value, $name)
	{
		$tagMatches = XXX_String_Pattern::getMatches($value, '\\[(' . $name . ')((?:[^\\]]*?)?)\\](?:(.*?)\\[/(' . $name . ')\\])?', 'i');
		
		$result = array();
		
		if (XXX_Array::getFirstLevelItemTotal($tagMatches))
		{
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($tagMatches[0]); $i < $iEnd; ++$i)
			{
				$original = $tagMatches[0][$i];
				$opening = $tagMatches[1][$i];
				$attributes = $tagMatches[2][$i];				
				$value = false;
				
				if (XXX_String::beginsWith($attributes, '='))
				{
					$value = XXX_String::getPart($attributes, 1, XXX_String::getCharacterLength($attributes) - 1);
				}
				
				if (!$value)
				{
					$attributes = XXX_String_RichTextFormatting::parseAttributes($attributes);
				}
				
				$inner = $tagMatches[3][$i];
				$closing = $tagMatches[4][$i];
				
				$result[] = array
				(
					'original' => $original,
					'name' => $name,
					'attributes' => $attributes,
					'value' => $value,
					'inner' => $inner,
					'closing' => $closing? true : false
				);
			}
		}
		
		return $result;
	}
	
	
	public static function parseAttributes ($attributes)
	{
		$attributeMatches = XXX_String_Pattern::getMatches($attributes, '\\s{1,}([a-z_]*)=(.*?)(?=\\s{1,}|$)', 'i');
		
		$names = array();
		$values = array();
		
		if (XXX_Array::getFirstLevelItemTotal($attributeMatches))
		{
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($attributeMatches[0]); $i < $iEnd; ++$i)
			{
				$names[] = $attributeMatches[1][$i];
				$values[] = $attributeMatches[2][$i];
			}
		}
		
		$result = array();
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($names); $i < $iEnd; ++$i)
		{
			$result[$names[$i]] = $values[$i];
		}
		
		return $result;
	}
		
	public static function removeTextFormatting ($value = '', $formatOptions = array())
	{
		$value = XXX_String::normalizeLineSeparators($value);
	
		$value = XXX_String::disableHTMLTags($value);
		
		if (XXX_Array::hasValue($formatOptions, 'emphasis'))
		{
			$value = XXX_String::replace($value, array('[strong]', '[/strong]'), array('', ''));
			$value = XXX_String::replace($value, array('[mild]', '[/mild]'), array('', ''));
		}
		
		if (XXX_Array::hasValue($formatOptions, 'edit'))
		{
			$value = XXX_String::replace($value, array('[inserted]', '[/inserted]'), array('', ''));
			$value = XXX_String::replace($value, array('[deleted]', '[/deleted]'), array('', ''));
		}
		
		if (XXX_Array::hasValue($formatOptions, 'heading'))
		{
			$value = XXX_String::replace($value, array('[heading1]', '[/heading1]'), array('', ''));
			$value = XXX_String::replace($value, array('[heading2]', '[/heading2]'), array('', ''));
			$value = XXX_String::replace($value, array('[heading3]', '[/heading3]'), array('', ''));
		}
				
		if (XXX_Array::hasValue($formatOptions, 'quote'))
		{
			$value = XXX_String::replace($value, array('[quote]', '[/quote]'), array('', ''));
		}
		
		if (XXX_Array::hasValue($formatOptions, 'textStyling'))
		{
			$value = XXX_String_Pattern::replace($value, '\\[text_color=([0-9A-Fa-f]{6})\\]', '', '');
			$value = XXX_String::replace($value, '[/text_color]', '');
			
			$value = XXX_String_Pattern::replace($value, '\\[highlight_color=([0-9A-Fa-f]{6})\\]', '', '');
			$value = XXX_String::replace($value, '[/highlight_color]', '');
			
			$value = XXX_String_Pattern::replace($value, '\\[text_size=(small|medium|large|normal)\\]', '', '');
			$value = XXX_String::replace($value, '[/text_size]', '');
			
			$value = XXX_String_Pattern::replace($value, '\\[text_font=(classic|computer|business|normal)\\]', '', '');
			$value = XXX_String::replace($value, '[/text_font]', '');
		}
				
		if (XXX_Array::hasValue($formatOptions, 'textAlignment'))
		{
			$value = XXX_String_Pattern::replace($value, '\\[text_align=(left|center|right)\\]', '', '');
			$value = XXX_String::replace($value, '[/text_align]', '');
		}
				
		if (XXX_Array::hasValue($formatOptions, 'list'))
		{
			$value = XXX_String::replace($value, array('[ordered_list]', '[/ordered_list]'), array('', ''));
			$value = XXX_String::replace($value, array('[unordered_list]', '[/unordered_list]'), array('', ''));
			$value = XXX_String::replace($value, array('[item]', '[/item]'), array('', ''));					
		}
		
		if (XXX_Array::hasValue($formatOptions, 'ruler'))
		{
			$value = XXX_String::replace($value, '[ruler]', '');
		}
		
		if (XXX_Array::hasValue($formatOptions, 'link') || XXX_Array::hasValue($formatOptions, 'linkOnly'))
		{
			$linkTags = XXX_String_RichTextFormatting::getTags($value, 'link');
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($linkTags); $i < $iEnd; ++$i)
			{
				$linkTag = $linkTags[$i];
								
				$value = XXX_String::replace($value, $linkTag['original'], $linkTag['inner']);
			}
		}
		
		if (XXX_Array::hasValue($formatOptions, 'link'))
		{
			
			$anchorTags = XXX_String_RichTextFormatting::getTags($value, 'anchor');
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($anchorTags); $i < $iEnd; ++$i)
			{
				$anchorTag = $anchorTags[$i];
				
				$value = XXX_String::replace($value, $anchorTag['original'], '');
			}
		}
		
		if (XXX_Array::hasValue($formatOptions, 'externalMedia'))
		{
			$imageTags = XXX_String_RichTextFormatting::getTags($value, 'image');
						
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($imageTags); $i < $iEnd; ++$i)
			{
				$imageTag = $imageTags[$i];
				
				$value = XXX_String::replace($value, $imageTag['original'], '');
			}
			
			
			$videoTags = XXX_String_RichTextFormatting::getTags($value, 'video');
						
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($videoTags); $i < $iEnd; ++$i)
			{
				$videoTag = $videoTags[$i];
				
				$value = XXX_String::replace($value, $videoTag['original'], '');
			}
		}
		
		return $value;
	}	
	
	/*
	
	public static function processTextFormatting ($value = '', $formatOptions = array())
	{
		$value = XXX_String::normalizeLineSeparators($value);
	
		$value = XXX_String::disableHTMLTags($value);
		
		$value = XXX_String_Pattern::replace($value, XXX_String::$lineSeparator, '', '<br>');
		
		if (XXX_Array::hasValue($formatOptions, 'emphasis'))
		{
			$value = XXX_String::replace($value, array('[strong]', '[/strong]'), array('<strong>', '</strong>'));
			$value = XXX_String::replace($value, array('[mild]', '[/mild]'), array('<em>', '</em>'));
		}
		
		if (XXX_Array::hasValue($formatOptions, 'edit'))
		{
			$value = XXX_String::replace($value, array('[inserted]', '[/inserted]'), array('<ins>', '</ins>'));
			$value = XXX_String::replace($value, array('[deleted]', '[/deleted]'), array('<del>', '</del>'));
		}
		
		if (XXX_Array::hasValue($formatOptions, 'heading'))
		{
			$value = XXX_String::replace($value, array('[heading1]', '[/heading1]'), array('<h1>', '</h1>'));
			$value = XXX_String::replace($value, array('[heading2]', '[/heading2]'), array('<h2>', '</h2>'));
			$value = XXX_String::replace($value, array('[heading3]', '[/heading3]'), array('<h3>', '</h3>'));
		}
				
		if (XXX_Array::hasValue($formatOptions, 'quote'))
		{
			$value = XXX_String::replace($value, array('[quote]', '[/quote]'), array('<blockquote>', '</blockquote>'));
		}
		
		if (XXX_Array::hasValue($formatOptions, 'textStyling'))
		{
			$value = XXX_String_Pattern::replace($value, '\\[text_color=([0-9A-Fa-f]{6})\\]', '', '<span style="color: #$1;">');
			$value = XXX_String::replace($value, '[/text_color]', '</span>');
			
			$value = XXX_String_Pattern::replace($value, '\\[highlight_color=([0-9A-Fa-f]{6})\\]', '', '<span style="background-color: #$1;">');
			$value = XXX_String::replace($value, '[/highlight_color]', '</span>');
			
			$value = XXX_String_Pattern::replace($value, '\\[text_size=(small|medium|large|normal)\\]', '', '<span class="XXX_TextEditor_textSize_$1">');
			$value = XXX_String::replace($value, '[/text_size]', '</span>');
			
			$value = XXX_String_Pattern::replace($value, '\\[text_font=(classic|computer|business|normal)\\]', '', '<span class="XXX_TextEditor_textFont_$1">');
			$value = XXX_String::replace($value, '[/text_font]', '</span>');
		}
				
		if (XXX_Array::hasValue($formatOptions, 'textAlignment'))
		{
			$value = XXX_String_Pattern::replace($value, '\\[text_align=(left|center|right)\\]', '', '<span class="XXX_TextEditor_textAlign_$1">');
			$value = XXX_String::replace($value, '[/text_align]', '</span>');
		}
				
		if (XXX_Array::hasValue($formatOptions, 'list'))
		{
			$value = XXX_String::replace($value, array('[ordered_list]', '[/ordered_list]'), array('<ol>', '</ol>'));
			$value = XXX_String::replace($value, array('[unordered_list]', '[/unordered_list]'), array('<ul>', '</ul>'));
			
			$value = XXX_String::replace($value, array('[item]', '[/item]'), array('<li>', '</li>'));	
			
			$value = XXX_String_Pattern::replaceCallback($value, '(<(?:ul|ol|/li)>)((?:\\s|<br>)*)(<(?:/ul|/ol|li)>)', '', function ($all, $before, $spacing, $after)
			{
				return $before . $after;
			});			
		}
		
		if (XXX_Array::hasValue($formatOptions, 'ruler'))
		{
			$value = XXX_String::replace($value, '[ruler]', '<hr>');
		}
		
		if (XXX_Array::hasValue($formatOptions, 'link') || XXX_Array::hasValue($formatOptions, 'linkOnly'))
		{
			// Auto convert links
			$linkMatches = XXX_String_Pattern::getMatches($value, '((?:link|source)=|])?((?:(?:https?|ftp)://)?(?:[-a-z0-9+&@#/%?=~_|!:,;]{2,}\\.){1,}[-a-z0-9+&@#/%?=~_|!:,;]{2,})', 'i');
			
			$result = array();
			
			if (XXX_Array::getFirstLevelItemTotal($linkMatches))
			{
				for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($linkMatches[0]); $i < $iEnd; ++$i)
				{
					$original = $linkMatches[0][$i];
					$prefix = $linkMatches[1][$i];
					$link = $linkMatches[2][$i];
					
					if (!($prefix == 'link=' || $prefix == 'source=' || $prefix == ']'))
					{
						$value = XXX_String::replace($value, $original, '[link=' . $link . ']' . $link . '[/link]');
					}
				}
			}
			
			// Link
			$linkTags = XXX_String_RichTextFormatting::getTags($value, 'link');
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($linkTags); $i < $iEnd; ++$i)
			{
				$linkTag = $linkTags[$i];
				
				$temp = '';
				
				if ($linkTag['value'])
				{
					$temp .= '<a';
					
					if (XXX_String::findFirstPosition($linkTag['value'], '.') != -1 && !XXX_String::beginsWith($linkTag, '#'))
					{
						if (!(XXX_String::beginsWith($linkTag['value'], 'http://') || XXX_String::beginsWith($linkTag['value'], 'https://')))
						{
							$linkTag['value'] = 'http://' . $linkTag['value'];
						}
						
						$temp .= ' href="' . $linkTag['value'] . '"';
						$temp .= ' target="_blank"';
					}
					else if (XXX_String::beginsWith($linkTag['value'], '#'))
					{
						$temp .= ' href="' . $linkTag['value'] . '"';
					}
					else if (!XXX_String::beginsWith($linkTag['value'], '#'))
					{
						$temp .= ' href="#' . $linkTag['value'] . '"';
					}
					
					$temp .= '>';
					
					$temp .= $linkTag['inner'];
					
					$temp .= '</a>';
				}
				
				$value = XXX_String::replace($value, $linkTag['original'], $temp);
			}			
		}
		
		if (XXX_Array::hasValue($formatOptions, 'link'))
		{
			
			$anchorTags = XXX_String_RichTextFormatting::getTags($value, 'anchor');
			
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($anchorTags); $i < $iEnd; ++$i)
			{
				$anchorTag = $anchorTags[$i];
				
				$temp = '';
				
				if ($anchorTag['value'])
				{
					$temp .= '<a';
					
					if (XXX_String::beginsWith($anchorTag['value'], '#'))
					{
						$anchorTag['value'] = XXX_String::getPart($anchorTag['value'], 1, XXX_String::getCharacterLength($anchorTag['value']) - 1);
					}
					
					$temp .= ' name="' . $anchorTag['value'] . '"';
					
					$temp .= '>';
					
					if (XXX_Type::isValue($anchorTag['inner']))
					{
						$temp .= $anchorTag['inner'];
					}
					
					$temp .= '</a>';
				}
				
				$value = XXX_String::replace($value, $anchorTag['original'], $temp);
			}
		}
		
		if (XXX_Array::hasValue($formatOptions, 'externalMedia'))
		{
			$imageTags = XXX_String_RichTextFormatting::getTags($value, 'image');
						
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($imageTags); $i < $iEnd; ++$i)
			{
				$imageTag = $imageTags[$i];
				
				$temp = '';
				
				if ($imageTag['attributes']['source'])
				{
					if (XXX_Array::hasValue($formatOptions, 'userImages') && XXX_Type::isNumeric($imageTag['attributes']['source']))
					{
						$imageTag['attributes']['source'] = false;
												
						if ($imageTag['attributes']['size'])
						{
							$originalWidth = XXX_Type::makeInteger($userImage['width']);
							$originalHeight = XXX_Type::makeInteger($userImage['height']);
							
							$desiredWidth = $originalWidth;
							$desiredHeight = $originalHeight;
							
							switch ($imageTag['attributes']['size'])
							{
								case 'small':
									$desiredWidth = 160;
									$desiredHeight = 160;
									break;
								case 'medium':
									$desiredWidth = 320;
									$desiredHeight = 320;
									break;
								case 'large':
									$desiredWidth = 640;
									$desiredHeight = 640;
									break;
							}
							
							$imageTag['attributes']['width'] = $newSize['width'];
							$imageTag['attributes']['height'] = $newSize['height'];
						}
					}
				
					if ($imageTag['attributes']['source'])
					{
						$temp = '<img';
						
						$temp .= ' src="' . $imageTag['attributes']['source'] . '"';
						
						if ($imageTag['attributes']['description'])
						{
							$temp .= ' alt="' . $imageTag['attributes']['description'] . '"';
							$temp .= ' title="' . $imageTag['attributes']['description'] . '"';
						}
						
						if ($imageTag['attributes']['width'])
						{
							$imageTag['attributes']['width'] = XXX_Type::makeInteger($imageTag['attributes']['width']);
							
							$imageTag['attributes']['width'] = XXX_Default::toIntegerRange($imageTag['attributes']['width'], 1, 1000, 640);
							
							$temp .= ' width="' . $imageTag['attributes']['width'] . '"';
						}
						
						if ($imageTag['attributes']['height'])
						{
							$imageTag['attributes']['height'] = XXX_Type::makeInteger($imageTag['attributes']['height']);
							
							$imageTag['attributes']['height'] = XXX_Default::toIntegerRange($imageTag['attributes']['height'], 1, 1000, 640);
							
							$temp .= ' height="' . $imageTag['attributes']['height'] . '"';
						}
						
						if ($imageTag['attributes']['position'])
						{
							$imageTag['attributes']['margin'] = XXX_Type::makeInteger($imageTag['attributes']['margin']);
							$imageTag['attributes']['margin'] = XXX_Default::toMinimumInteger($imageTag['attributes']['margin'], 1, 10);
							
							switch ($imageTag['attributes']['position'])
							{
								case 'left':
									$temp .= ' style="float: left; margin: ' . $imageTag['attributes']['margin'] . 'px;"';
									break;
								case 'right':
									$temp .= ' style="float: right; margin: ' . $imageTag['attributes']['margin'] . 'px;"';
									break;
							}
						}
						else
						{
							$imageTag['attributes']['margin'] = XXX_Type::makeInteger($imageTag['attributes']['margin']);
							
							if (!XXX_Type::isPositiveNumber($imageTag['attributes']['margin']))
							{
								$imageTag['attributes']['margin'] = 0;
							}
							
							$temp .= ' style="margin: ' . $imageTag['attributes']['margin'] . 'px;"';
						}
						
						$temp .= '>';	
					}
				}
				
				$value = XXX_String::replace($value, $imageTag['original'], $temp);
			}
		
		
		
			$videoTags = XXX_String_RichTextFormatting::getTags($value, 'video');
						
			for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($videoTags); $i < $iEnd; ++$i)
			{
				$videoTag = $videoTags[$i];
				
				$videoSource = false;
				
				if (!XXX_Type::isPositiveNumeric($videoTag['attributes']['width']))
				{
					$videoTag['attributes']['width'] = XXX_Type::makeInteger($videoTag['attributes']['width']);
						
					$videoTag['attributes']['width'] = XXX_Default::toIntegerRange($videoTag['attributes']['width'], 1, 1920, 480);
				}
				
				if (!XXX_Type::isPositiveNumeric($videoTag['attributes']['height']))
				{
					$videoTag['attributes']['height'] = XXX_Type::makeInteger($videoTag['attributes']['height']);
						
					$videoTag['attributes']['height'] = XXX_Default::toIntegerRange($videoTag['attributes']['height'], 1, 1920, 320);
				}
				
				
				$videoID = false;
								
				// YouTube Video
				if (XXX_String::findFirstPosition(XXX_String::convertToLowerCase($videoTag['attributes']['source']), 'youtube.com') != -1)
				{
					
					// http://www.youtube.com/v/kG2BYhjQIKQ&hl=en_US&fs=1
					
					$videoIDMatches = XXX_String_Pattern::getMatches($videoTag['attributes']['source'], '(?:v=|/v/)([a-z0-9=]{1,})', 'i');
					
					if (XXX_Array::getFirstLevelItemTotal($videoIDMatches[1]))
					{
						$videoID = $videoIDMatches[1][0];
					}
					
					$videoSource = 'http://www.youtube.com/v/' . $videoID . '&hl=en_US&fs=1';
				}
				
				// Google Video
				else if (XXX_String::findFirstPosition(XXX_String::convertToLowerCase($videoTag['attributes']['source']), 'video.google.com') != -1)
				{
					// http://video.google.com/googleplayer.swf?docid=-8967914974980683249&hl=en&fs=true
					
					$videoIDMatches = XXX_String_Pattern::getMatches($videoTag['attributes']['source'], 'docid=(-?[0-9]{1,})', 'i');
					
					if (XXX_Array::getFirstLevelItemTotal($videoIDMatches[1]))
					{
						$videoID = $videoIDMatches[1][0];
					}
					
					$videoSource = 'http://video.google.com/googleplayer.swf?docid=' . $videoID . '&hl=en&fs=true';
				}
				
				// Vimeo video
				else if (XXX_String::findFirstPosition(XXX_String::convertToLowerCase($videoTag['attributes']['source']), 'vimeo.com') != -1)
				{
					// http://vimeo.com/moogaloop.swf?clip_id=8423116&server=vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=&fullscreen=1
					
					$videoIDMatches = XXX_String_Pattern::getMatches($videoTag['attributes']['source'], '(?:clip_id=|vimeo\.com/)([0-9]{1,})', 'i');
					
					if (XXX_Array::getFirstLevelItemTotal($videoIDMatches[1]))
					{
						$videoID = $videoIDMatches[1][0];
					}
					
					$videoSource = 'http://vimeo.com/moogaloop.swf?clip_id=' . $videoID . '&server=vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=&fullscreen=1';					
				}
								
				$temp = '';
				
				if ($videoSource)
				{
					$temp .= '<object';
					
					$temp .= ' width="' . $videoTag['attributes']['width'] . '"';
					$temp .= ' height="' . $videoTag['attributes']['height'] . '"';
					
					if ($videoTag['attributes']['description'])
					{
						$temp .= ' title' . $videoTag['attributes']['description'] . '"';	
					}
					
					$temp .= '>';
									
					$temp .= '<param name="allowfullscreen" value="true"></param>';					
					$temp .= '<param name="allowscriptaccess" value="always"></param>';
					$temp .= '<param name="movie" value="' . $videoSource . '"></param>';	
					
					$temp .= '<embed';
					$temp .= ' type="application/x-shockwave-flash"';
					$temp .= ' allowfullscreen="true"';
					$temp .= ' allowscriptaccess="always"';
					$temp .= ' width="' . $videoTag['attributes']['width'] . '"';
					$temp .= ' height="' . $videoTag['attributes']['height'] . '"';
					$temp .= ' src="' . $videoSource . '"';
					
					if ($videoTag['attributes']['description'])
					{
						$temp .= ' title' . $videoTag['attributes']['description'] . '"';	
					}
					
					$temp .= '>';
					
					$temp .= '</embed>';
					
					$temp .= '</object>';
				}
				
				$value = XXX_String::replace($value, $videoTag['original'], $temp);
			}
		}
		
		return $value;
	}
	
	*/
}

?>